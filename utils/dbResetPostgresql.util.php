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
    'User_table' => 'database/User_table.sql',
    'SectCouriers_table' => 'database/SectCouriers.sql',
    'Deliveries_table' => 'database/Deliveries.sql',
    'courier_deliveries' => 'database/courier_deliveries.sql',
];

foreach ($sqlFiles as $table => $file) {
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
    'SectCouriers_table',
    'User_table',
];
foreach ($tables as $table) {
    $pdo->exec("TRUNCATE TABLE \"$table\" RESTART IDENTITY CASCADE;");
}

echo "✅ PostgreSQL reset complete!\n";
