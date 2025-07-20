<?php
declare(strict_types=1);
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/user.util.php';
require_once UTILS_PATH . '/envSetter.util.php';

Auth::init();

$host = 'host.docker.internal';
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$action = $_REQUEST['action'] ?? null;

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? '';
    $data = [
        'username'   => $_POST['username'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name'  => $_POST['last_name'] ?? '',
        'email'      => $_POST['email'] ?? '',
        'role'       => $_POST['role'] ?? '',
        'password'   => $_POST['password'] ?? '', // Optional, only update if provided
    ];
    $success = userDatabase::updateById($pdo, $user_id, $data);
    header('Location: /pages/accountPage/index.php?message=' . ($success ? 'updated' : 'update_failed'));
    exit;
}

// Default: View all users
$users = userDatabase::ViewAll($pdo);
header('Content-Type: application/json');
echo json_encode($users);
exit;?>