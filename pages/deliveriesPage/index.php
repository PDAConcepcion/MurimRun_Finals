<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/deliveries.util.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/envSetter.util.php';

$mongoCheckerResult = require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
$postgresCheckerResult = require_once HANDLERS_PATH . '/postgreChecker.handler.php';

Auth::init();
$user = Auth::user();

if (!$user || empty($user['id'])) {
    header('Location: /errors/forbidden.error.php');
    exit;
}

// Setup DB connection
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$deliveries = Deliveries::getAllWithCourierAndSectByUserId($pdo, $user['id']);

$pageCss = [
    '../../assets/css/style.css',
    '../../assets/css/footer.css',
    '../../assets/css/header.css',
    'assets/css/deliveries.css'
];

$pageJs = [
    'assets/js/deliveries.js'
];

renderMainLayout(function () use ($deliveries) { ?>
    <div class="page">
        <div class="container">
            <div class="title-section">
                <img src="/assets/img/murimrun-icons/murimrun-deliveries.png" alt="">
                <h1>Orders</h1>


            </div>
            <p>
                Learn everything about your package in this section. <br>
                Track the current location, check the status, and find
                out when your package will arrive!
            </p>

            <section class="dlv-sec">
                <!-- This is the new table -->
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Courier Name</th>
                            <th>Sect Name</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>ETA</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($deliveries)): ?>
                            <?php foreach ($deliveries as $delivery): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($delivery['delivery_id']) ?></td>
                                    <td><?= htmlspecialchars($delivery['courier_name']) ?></td>
                                    <td><?= htmlspecialchars($delivery['sect_name']) ?></td>
                                    <td><?= htmlspecialchars($delivery['origin']) ?></td>
                                    <td><?= htmlspecialchars($delivery['destination']) ?></td>
                                    <td><?= htmlspecialchars($delivery['delivery_time_estimate']) ?></td>
                                    <td><?= htmlspecialchars($delivery['status']) ?></td>
                                    <td>
                                        <?php if (strtolower($delivery['status']) === 'pending' || strtolower($delivery['status']) === 'in transit'): ?>
                                            <button class="cancel-btn" data-id="<?= htmlspecialchars($delivery['delivery_id']) ?>">Cancel</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No deliveries found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

<?php }, 'Orders', ['css' => $pageCss, 'js' => $pageJs]); ?>