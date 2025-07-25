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
    $reference_user_id = $original_user['user_id'] ?? '';

    $data = [
        'username'   => $_POST['username'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name'  => $_POST['last_name'] ?? '',
        'email'      => $_POST['email'] ?? '',
        'role'       => $_POST['role'] ?? '',
        'password'   => $_POST['password'] ?? '',
    ];

    $success = userDatabase::updateById($pdo, $reference_user_id, $data);

    // Update session if successful
    if ($success) {
        $updatedUser = userDatabase::getById($pdo, $reference_user_id);
        // Update session user (assuming Auth uses $_SESSION['user'])
        $_SESSION['user'] = [
            'id' => $updatedUser['user_id'],
            'username' => $updatedUser['username'],
            'email' => $updatedUser['email'],
            'role' => $updatedUser['role'],
            // add other fields as needed
        ];
    }

    header('Location: /pages/accountPage/index.php?message=' . ($success ? 'updated' : 'update_failed'));
    exit;
}

if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['user_ids'] ?? [];
    $success = true;
    foreach ($ids as $user_id) {
        $success = $success && userDatabase::removeById($pdo, $user_id);
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}

// Default: View all users
$users = userDatabase::ViewAll($pdo);
header('Content-Type: application/json');
echo json_encode($users);
exit;?>