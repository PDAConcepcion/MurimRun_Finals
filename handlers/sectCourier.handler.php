<?php 
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/sectCourier.util.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.utils.php';

// Initialize authentication/session
Auth::init();

// Set up database connection parameters
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

// Create PDO instance for PostgreSQL connection
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

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

if ($action === 'updateById' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['courier_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing courier_id parameter']);
        exit;
    }
    $data = [
        'name' => $_POST['name'] ?? '',
        'sectname' => $_POST['sectname'] ?? '',
        'rank' => $_POST['rank'] ?? '',
        'speedrating' => $_POST['speedrating'] ?? 0,
        'status' => $_POST['status'] ?? 'Available',
    ];
    $success = SectCouriers::updateById($pdo, $_POST['courier_id'], $data);
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}

if ($action === 'checkDelete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['courier_ids'] ?? [];
    $hasDeliveries = false;
    $deliveriesCount = 0;
    foreach ($ids as $id) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM public."Deliveries_table" WHERE courier_id = :courier_id');
        $stmt->execute([':courier_id' => $id]);
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
        $ids = $_POST['courier_ids'] ?? [];
        $success = true;
        foreach ($ids as $id) {
            // Get all delivery_ids for this courier
            $stmt = $pdo->prepare('SELECT delivery_id FROM public."Deliveries_table" WHERE courier_id = :courier_id');
            $stmt->execute([':courier_id' => $id]);
            $deliveryIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Delete from courier_deliveries first
            if (!empty($deliveryIds)) {
                $in = implode(',', array_fill(0, count($deliveryIds), '?'));
                $pdo->prepare("DELETE FROM public.\"courier_deliveries\" WHERE delivery_id IN ($in)")
                    ->execute($deliveryIds);
            }

            // Delete all deliveries for this courier
            $stmt = $pdo->prepare('DELETE FROM public."Deliveries_table" WHERE courier_id = :courier_id');
            $stmt->execute([':courier_id' => $id]);

            // Then, delete the courier
            $success = $success && SectCouriers::removeById($pdo, $id);
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    } catch (Throwable $e) {
        header('Content-Type: application/json', true, 500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}
?>