<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/sectCourier.util.php';
require_once UTILS_PATH . '/envSetter.util.php';

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

// Fetch couriers from DB
$couriers = SectCouriers::getAll($pdo);

$pageCss = [
    '../../assets/css/footer.css',
    '../../assets/css/header.css',
    '../../assets/css/style.css',
    '/assets/css/userPage.css'
];

$pageJs = [
    'assets/js/userPage.js'
];

renderMainLayout(function () use ($couriers): void { ?>
    <section class="user-page">
        <div class="page-header">
            <h1>Available Couriers</h1>
            <a href="../accountPage/" class="btn btn-secondary">Edit Profile</a>
        </div>
        <div class="courier-list">
            <?php foreach ($couriers as $courier): ?>
                <div class="courier-card">
                    <img src="<?= htmlspecialchars($courier['image']) ?? '../../assets/img/nyebe_white.png' ?>" alt="<?= htmlspecialchars($courier['name']) ?> Logo" class="courier-logo">
                    <div class="courier-info">
                        <h3 class="courier-name"><?= htmlspecialchars($courier['name']) ?></h3>
                        <p class="courier-details"><?= htmlspecialchars($courier['details']) ?></p>
                    </div>
                    <button class="btn btn-primary select-courier-btn" data-courier-id="<?= $courier['id'] ?>">Select Courier</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php }, 'User Dashboard - MurimRun', ['css' => $pageCss, 'js' => $pageJs]);