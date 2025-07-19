<?php 
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/sectCouriers.utils.php';
require_once UTILS_PATH . '/DBConnection.php';

// Initialize authentication/session
Auth::init();

// Set up database connection parameters
$pdo = DBConnection::getPDO();

// Get action from request (GET or POST)
$action = $_REQUEST['action'] ?? null;

if ($action === 'getAll') {
    $couriers = SectCouriers::getAll($pdo);
    header('Content-Type: application/json');
    echo json_encode($couriers);
    exit;
}

if ($action === 'getByName' && isset($_GET['name'])) {
    $courier = SectCouriers::getByName($pdo, $_GET['name']);
    header('Content-Type: application/json');
    echo json_encode($courier);
    exit;
}

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'sectname' => $_POST['sectname'] ?? '',
        'rank' => $_POST['rank'] ?? '',
        'speedrating' => $_POST['speedrating'] ?? 0,
        'status' => $_POST['status'] ?? 'Available',
    ];
    SectCouriers::add($pdo, $data);
    header('Location: /pages/sectCouriers/index.php?message=added');
    exit;
}

if ($action === 'updateByName' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['oldName'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing oldName parameter']);
        exit;
    }
    $data = [
        'name' => $_POST['name'] ?? $_POST['oldName'],
        'sectname' => $_POST['sectname'] ?? '',
        'rank' => $_POST['rank'] ?? '',
        'speedrating' => $_POST['speedrating'] ?? 0,
        'status' => $_POST['status'] ?? 'Available',
    ];
    $success = SectCouriers::updateByName($pdo, $_POST['oldName'], $data);
    header('Location: /pages/sectCouriers/index.php?message=' . ($success ? 'updated' : 'update_failed'));
    exit;
}

if ($action === 'removeByName' && isset($_POST['name'])) {
    $success = SectCouriers::removeByName($pdo, $_POST['name']);
    header('Location: /pages/sectCouriers/index.php?message=' . ($success ? 'removed' : 'remove_failed'));
    exit;
}
?>