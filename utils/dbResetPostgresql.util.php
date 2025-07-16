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

// Drop all actual tables for a true reset
$tables = [
    'courier_deliveries',
    'Deliveries_table',
    'SectCouriers_table',
    'User_table',
];
echo "Dropping tables…\n";
foreach ($tables as $table) {
    try {
        $pdo->exec("DROP TABLE IF EXISTS \"$table\" CASCADE;");
        echo "Dropped $table\n";
    } catch (Exception $e) {
        echo "Warning: Could not drop $table ({$e->getMessage()})\n";
    }
}

// Recreate tables from SQL files
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
