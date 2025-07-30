<?php
declare(strict_types=1);
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}


// 1) Composer autoload
require_once BASE_PATH . '/vendor/autoload.php';

// 2) Composer bootstrap
require_once BASE_PATH . '/bootstrap.php';

// 3) envSetter
require_once ENVSETTER_PATH;

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

// Drop all actual tables
echo "Dropping old tables…\n";
foreach ([
  'courier_deliveries',
  'Deliveries_table',
  'SectCouriers_table',
  'User_table',
] as $table) {
  $pdo->exec("DROP TABLE IF EXISTS \"$table\" CASCADE;");
}

// Recreate tables from existing SQL files
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

echo "✅ PostgreSQL migration complete!\n";

