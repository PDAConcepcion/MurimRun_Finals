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
    ['table' => 'User_table', 'file' => 'database/User_table.sql'],
    ['table' => 'SectCouriers_yable', 'file' => 'database/SectCouriers.sql'],
    ['table' => 'Deliveries_table', 'file' => 'database/Deliveries.sql'],
    ['table' => 'courier_deliveries', 'file' => 'database/courier_deliveries.sql'],
];

foreach ($sqlFiles as $entry) {
    $table = $entry['table'];
    $file = $entry['file'];
    echo "Dropping table $table if exists…\n";
    $pdo->exec("DROP TABLE IF EXISTS public.\"$table\" CASCADE;");
    echo "Applying schema from $file…\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        throw new RuntimeException("Could not read $file");
    } else {
        echo "Creation Success from $file\n";
    }
    $pdo->exec($sql);
}

// Truncate tables
echo "Truncating tables…\n";
$tables = [
    'courier_deliveries',
    'Deliveries_table',
    'SectCouriers_yable',
    'User_table',
];
foreach ($tables as $table) {
    $pdo->exec("TRUNCATE TABLE \"$table\" RESTART IDENTITY CASCADE;");
}

// Seeder logic for users
echo "Seeding users…\n";
$users = require_once __DIR__ . '/../staticDatas/dummies/users.staticData.php';
$userStmt = $pdo->prepare(
    'INSERT INTO public."User_table" (username, password, first_name, last_name, "role") VALUES (:username, :pw, :fn, :ln, :role)'
);
foreach ($users as $u) {
    $userStmt->execute([
        ':username' => $u['username'],
        ':pw' => password_hash($u['password'], PASSWORD_DEFAULT),
        ':fn' => $u['first_name'],
        ':ln' => $u['last_name'],
        ':role' => $u['role'],
    ]);
}

// Seeder logic for SectCouriers_yable
echo "Seeding sect couriers…\n";
$sectCouriers = require_once __DIR__ . '/../staticDatas/dummies/sectcouriers.staticData.php';
$sectCourierStmt = $pdo->prepare(
    'INSERT INTO public."SectCouriers_yable" (name, sectname, rank, speedrating, status) VALUES (:name, :sectname, :rank, :speedrating, :status)'
);
foreach ($sectCouriers as $sc) {
    $sectCourierStmt->execute([
        ':name' => $sc['name'],
        ':sectname' => $sc['sectname'],
        ':rank' => $sc['rank'],
        ':speedrating' => $sc['speedrating'],
        ':status' => $sc['status'],
    ]);
}

// Seeder logic for Deliveries_table
echo "Seeding deliveries…\n";
// Get foreign keys for dummy data
$userid = $pdo->query('SELECT userid FROM public."User_table" LIMIT 1')->fetchColumn();
$courierid = $pdo->query('SELECT courierid FROM public."SectCouriers_yable" LIMIT 1')->fetchColumn();
$deliveries = require_once __DIR__ . '/../staticDatas/dummies/deliveries.static.Data.php';
$deliveryStmt = $pdo->prepare(
    'INSERT INTO public."Deliveries_table" (userid, courierid, origin, destination, packagedescription, status, deliverytimeestimate) VALUES (:userid, :courierid, :origin, :destination, :packagedescription, :status, :deliverytimeestimate)'
);
foreach ($deliveries as $d) {
    $deliveryStmt->execute([
        ':userid' => $userid,
        ':courierid' => $courierid,
        ':origin' => $d['origin'],
        ':destination' => $d['destination'],
        ':packagedescription' => $d['packagedescription'],
        ':status' => $d['status'],
        ':deliverytimeestimate' => $d['deliverytimeestimate'],
    ]);
}

// Seeder logic for courier_deliveries
echo "Seeding courier deliveries…\n";
$courierDeliveries = [
    [
        'courierid' => null, // will be set below
        'deliveryid' => null, // will be set below
    ],
];
// Get ids for foreign keys
$courierid = $pdo->query('SELECT courierid FROM public."SectCouriers_yable" LIMIT 1')->fetchColumn();
$deliveryid = $pdo->query('SELECT deliveryid FROM public."Deliveries_table" LIMIT 1')->fetchColumn();
if ($courierid && $deliveryid) {
    $courierDeliveries[0]['courierid'] = $courierid;
    $courierDeliveries[0]['deliveryid'] = $deliveryid;
    $courierDeliveryStmt = $pdo->prepare(
        'INSERT INTO public."courier_deliveries" (courierid, deliveryid) VALUES (:courierid, :deliveryid)'
    );
    foreach ($courierDeliveries as $cd) {
        $courierDeliveryStmt->execute([
            ':courierid' => $cd['courierid'],
            ':deliveryid' => $cd['deliveryid'],
        ]);
    }
}

echo "✅ PostgreSQL reset complete!\n";
