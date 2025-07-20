<?php
declare(strict_types=1);
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/userView.util.php';
require_once UTILS_PATH . '/DBConnection.php';

Auth::init();

$pdo = DBConnection::getPDO();

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