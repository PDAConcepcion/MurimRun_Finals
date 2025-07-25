<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/deliveries.util.php';
require_once UTILS_PATH . '/sectCourier.util.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/envSetter.util.php';

Auth::init();

$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$action = $_REQUEST['action'] ?? null;

if ($action === 'getAll') {
    $deliveries = Deliveries::getAll($pdo);
    header('Content-Type: application/json');
    echo json_encode($deliveries);
    exit;
}

if ($action === 'getById' && isset($_GET['delivery_id'])) {
    $delivery = Deliveries::getById($pdo, $_GET['delivery_id']);
    header('Content-Type: application/json');
    echo json_encode($delivery);
    exit;
}

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'user_id' => $_POST['user_id'] ?? '',
        'courier_id' => $_POST['courier_id'] ?? '',
        'origin' => $_POST['origin'] ?? '',
        'destination' => $_POST['destination'] ?? '',
        'package_description' => $_POST['package_description'] ?? '',
        'status' => $_POST['status'] ?? 'Pending',
        'delivery_time_estimate' => $_POST['delivery_time_estimate'] ?? '',
        'weight_kg' => (float)($_POST['weight_kg'] ?? 0),
    ];
    $success = Deliveries::add($pdo, $data);

    // Set courier as unavailable if delivery was added
    if ($success && !empty($data['courier_id'])) {
        SectCouriers::setStatus($pdo, $data['courier_id'], false);
    }

    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}

if ($action === 'updateById' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['delivery_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing delivery_id parameter']);
        exit;
    }
    $data = [
        'origin' => $_POST['origin'] ?? '',
        'destination' => $_POST['destination'] ?? '',
        'package_description' => $_POST['package_description'] ?? '',
        'status' => $_POST['status'] ?? 'Pending',
        'delivery_time_estimate' => $_POST['delivery_time_estimate'] ?? '',
        'weight_kg' => (float)($_POST['weight_kg'] ?? 0),
    ];
    $success = Deliveries::updateById($pdo, $_POST['delivery_id'], $data);
    header('Location: /pages/deliveries/index.php?message=' . ($success ? 'updated' : 'update_failed'));
    exit;
}

if ($action === 'removeById' && isset($_POST['delivery_id'])) {
    $success = Deliveries::removeById($pdo, $_POST['delivery_id']);
    header('Location: /pages/deliveries/index.php?message=' . ($success ? 'removed' : 'remove_failed'));
    exit;
}