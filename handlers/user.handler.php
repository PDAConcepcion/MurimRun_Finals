<?php
declare(strict_types=1);
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/user.utils.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.utils.php';

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
    $original_user = json_decode($_POST['original_user'] ?? '{}', true);

    // Use original_user['user_id'] or another unique field as reference
    $reference_user_id = $original_user['user_id'] ?? '';

    $data = [
        'username'   => $_POST['username'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name'  => $_POST['last_name'] ?? '',
        'email'      => $_POST['email'] ?? '',
        'role'       => $_POST['role'] ?? '',
        'password'   => $_POST['password'] ?? '', // Optional
    ];
    
    $success = userDatabase::updateById($pdo, $reference_user_id, $data);
    header('Location: /pages/accountPage/index.php?message=' . ($success ? 'updated' : 'update_failed'));
    exit;
}

// Default: View all users
$users = userDatabase::ViewAll($pdo);
header('Content-Type: application/json');
echo json_encode($users);
exit;?>