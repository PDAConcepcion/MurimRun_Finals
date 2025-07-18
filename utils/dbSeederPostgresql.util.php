<?php
declare(strict_types=1);

// 1) Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// 2) Composer bootstrap
require_once __DIR__ . '/../bootstrap.php';

// 3) envSetter
require_once __DIR__ . '/envSetter.util.php';

$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

// ——— Connect to PostgreSQL ———
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$sqlFiles = [
    'database/User_table.sql',
    'database/SectCouriers.sql',
    'database/Deliveries.sql',
    'database/courier_deliveries.sql',
];

foreach ($sqlFiles as $file) {
    echo "Applying schema from $file…\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        throw new RuntimeException("Could not read $file");
    } else {
        echo "Creation Success from $file\n";
    }
    $pdo->exec($sql);
}

echo "✅ PostgreSQL reset complete!\n";

// Truncate tables
echo "Truncating tables…\n";
$tables = [
    'courier_deliveries',
    'Deliveries_table',
    'SectCouriers_table',
    'User_table',
];
foreach ($tables as $table) {
    $pdo->exec("TRUNCATE TABLE \"$table\" RESTART IDENTITY CASCADE;");
}

// --- Seeder Logic for All Tables ---
echo "\n--- Seeding Dummy Data for All Tables ---\n";

// Seed User_table
echo "Seeding users…\n";
$users = @include DUMMIES_PATH . '/users.staticData.php';
if (is_array($users) && count($users)) {
    $stmt = $pdo->prepare('INSERT INTO public."User_table" (username, first_name, last_name, password, role, email) VALUES (:username, :first_name, :last_name, :password, :role, :email)');
    foreach ($users as $u) {
        $stmt->execute([
            ':username' => $u['username'],
            ':first_name' => $u['first_name'],
            ':last_name' => $u['last_name'],
            ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
            ':role' => $u['role'],
            ':email' => $u['email'],
        ]);
    }
    echo "Inserted " . count($users) . " users into User_table.\n";
} else {
    echo "No user dummy data found.\n";
}

// Seed SectCouriers_table
echo "Seeding sect couriers…\n";
$sectCouriers = @include DUMMIES_PATH . '/sectcouriers.staticData.php';
if (is_array($sectCouriers) && count($sectCouriers)) {
    $stmt = $pdo->prepare('INSERT INTO public."SectCouriers_table" (name, sectname, rank, speedrating, status, image) VALUES (:name, :sectname, :rank, :speedrating, :status, :image)');
    foreach ($sectCouriers as $sc) {
        $stmt->execute([
            ':name' => $sc['name'],
            ':sectname' => $sc['sectname'],
            ':rank' => $sc['rank'],
            ':speedrating' => $sc['speedrating'],
            ':status' => $sc['status'],
            ':image' => $sc['image'],
        ]);
    }
    echo "Inserted " . count($sectCouriers) . " sect couriers into SectCouriers_table.\n";
} else {
    echo "No sect couriers dummy data found.\n";
}

// Seed Deliveries_table
echo "Seeding deliveries…\n";
$deliveries = @include DUMMIES_PATH . '/deliveries.staticData.php';
$userid = $pdo->query('SELECT userid FROM public."User_table" LIMIT 1')->fetchColumn();
$courierid = $pdo->query('SELECT courierid FROM public."SectCouriers_table" LIMIT 1')->fetchColumn();
if (is_array($deliveries) && count($deliveries)) {
    $stmt = $pdo->prepare('INSERT INTO public."Deliveries_table" (userid, courierid, origin, destination, packagedescription, status, weight_kg, deliverytimeestimate) VALUES (:userid, :courierid, :origin, :destination, :packagedescription, :status, :weight_kg, :deliverytimeestimate)');
    foreach ($deliveries as $d) {
        // Ensure 'return' is a boolean, default to false if missing or empty
        //$returnValue = isset($d['return']) && $d['return'] !== '' ? (bool)$d['return'] : false;
        $stmt->execute([
            ':userid' => $userid,
            ':courierid' => $courierid,
            ':origin' => $d['origin'],
            ':destination' => $d['destination'],
            ':packagedescription' => $d['packagedescription'],
            ':status' => $d['status'],
            ':weight_kg' => $d['weight_kg'],
            ':deliverytimeestimate' => $d['deliverytimeestimate'],

        ]);
    }
    echo "Inserted " . count($deliveries) . " deliveries into Deliveries_table.\n";
} else {
    echo "No deliveries dummy data found.\n";
}

// Seed courier_deliveries
echo "Seeding courier deliveries…\n";
$deliveryids = $pdo->query('SELECT deliveryid FROM public."Deliveries_table"')->fetchAll(PDO::FETCH_COLUMN);
$courierid = $pdo->query('SELECT courierid FROM public."SectCouriers_table" LIMIT 1')->fetchColumn();
$count = 0;
foreach ($deliveryids as $deliveryid) {
    if ($courierid && $deliveryid) {
        $stmt = $pdo->prepare('INSERT INTO public."courier_deliveries" (courierid, deliveryid) VALUES (:courierid, :deliveryid)');
        $stmt->execute([
            ':courierid' => $courierid,
            ':deliveryid' => $deliveryid,
        ]);
        $count++;
    }
}
echo "Inserted $count courier deliveries into courier_deliveries.\n";

echo "✅ PostgreSQL seeding complete!\n";
