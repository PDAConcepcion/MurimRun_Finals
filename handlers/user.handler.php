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

if ($action === 'viewAll') {
    $users = userDatabase::ViewAll($pdo);
    header('Content-Type: application/json');
    echo json_encode($users);
    exit;
}

if ($action === 'viewByEmail' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $user = userDatabase::ViewByEmail($pdo, $email);
    header('Content-Type: application/json');
    echo json_encode($user);
    exit;
}

if ($action === 'updateByEmail' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $data = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'username' => $_POST['username'] ?? '',
        'role' => $_POST['role'] ?? '',
    ];
    $success = userDatabase::updateByEmail($pdo, $email, $data);
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}