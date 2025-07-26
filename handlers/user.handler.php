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

if ($action === 'updateById' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['user_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing user_id parameter']);
        exit;
    }
    $user_id = $_POST['user_id'];
    $data = [
        'username'   => $_POST['username'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name'  => $_POST['last_name'] ?? '',
        'email'      => $_POST['email'] ?? '',
        'role'       => $_POST['role'] ?? '',
        'password'   => $_POST['password'] ?? '',
    ];
    $success = userDatabase::updateById($pdo, $user_id, $data);
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}

if ($action === 'checkDelete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['user_ids'] ?? [];
    $hasDeliveries = false;
    $deliveriesCount = 0;
    foreach ($ids as $id) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM public."Deliveries_table" WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $id]);
        $count = (int)$stmt->fetchColumn();
        if ($count > 0) {
            $hasDeliveries = true;
            $deliveriesCount += $count;
        }
    }
    header('Content-Type: application/json');
    echo json_encode(['hasDeliveries' => $hasDeliveries, 'deliveriesCount' => $deliveriesCount]);
    exit;
}

if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $ids = $_POST['user_ids'] ?? [];
        $success = true;
        foreach ($ids as $id) {
            // Get all delivery_ids for this user
            $stmt = $pdo->prepare('SELECT delivery_id FROM public."Deliveries_table" WHERE user_id = :user_id');
            $stmt->execute([':user_id' => $id]);
            $deliveryIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Delete from courier_deliveries first (if such a table exists)
            if (!empty($deliveryIds)) {
                $in = implode(',', array_fill(0, count($deliveryIds), '?'));
                $pdo->prepare("DELETE FROM public.\"courier_deliveries\" WHERE delivery_id IN ($in)")
                    ->execute($deliveryIds);
            }

            // Delete all deliveries for this user
            $stmt = $pdo->prepare('DELETE FROM public."Deliveries_table" WHERE user_id = :user_id');
            $stmt->execute([':user_id' => $id]);

            // Then, delete the user
            $success = $success && userDatabase::removeById($pdo, $id);
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    } catch (Throwable $e) {
        header('Content-Type: application/json', true, 500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

// Default: View all users
$users = userDatabase::ViewAll($pdo);
header('Content-Type: application/json');
echo json_encode($users);
exit;?>