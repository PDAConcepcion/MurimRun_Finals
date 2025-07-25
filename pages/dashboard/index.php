<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/sectCourier.util.php';
require_once UTILS_PATH . '/deliveries.util.php';
require_once UTILS_PATH . '/envSetter.util.php';

// Setup DB connection using envSetter
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$user = Auth::user();
$sectCouriers = SectCouriers::getAll($pdo);
$deliveries = Deliveries::getAll($pdo);

$pageCss = [
    // '/assets/css/style.css',
    'assets/css/dashboard.css',
    '../../assets/css/header.css',
    '../../assets/css/footer.css',
    '../../assets/css/style.css'
];

$pageJs = [
    'assets/js/dashboard.js'
];

renderMainLayout(function () use ($sectCouriers, $user) { ?>

    <div class="background order">
        <div class="overlay"></div>
    </div>
    <div class="page">
        <div class="head-title">
            <h1 class="head-text">Dashboard</h1>
            <p class="time-text"><?php echo date("D, M j Y") ?></p>
        </div>
        <div class="user-dash">
            <div class="courier-pick">
                <?php foreach ($sectCouriers as $courier): ?>
                    <div class="courier-container sh<?php echo !$courier['status'] ? ' grayed-out' : ''; ?>">
                        <div class="courier-img">
                            <img src="<?php echo !empty($courier['image']) ? htmlspecialchars($courier['image']) : '../../assets/img/nyebe_white.png'; ?>"
                                alt="<?php echo htmlspecialchars($courier['name']); ?> Logo" class="courier-logo">
                        </div>
                        <div class="info-block">
                            <div class="info-type">
                                <?php foreach ($courier as $key => $value): ?>
                                    <?php
                                    if (in_array($key, ['courier_id', 'image']))
                                        continue;
                                    $label = ucwords(str_replace(['_', 'id'], [' ', ' ID'], $key));
                                    ?>
                                    <p class="info"><?php echo $label; ?>:</p>
                                <?php endforeach; ?>
                            </div>
                            <div class="info-result">
                                <?php foreach ($courier as $key => $value): ?>
                                    <?php
                                    if (in_array($key, ['courier_id', 'image']))
                                        continue;
                                    $display = ($key === 'status') ? ($value ? 'Available' : 'Unavailable') : htmlspecialchars($value);
                                    ?>
                                    <p class="info"><strong><?php echo $display; ?></strong></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="choice">
                            <button class="btn-3 sc select-btn" type="button"
                                data-courier="<?php echo htmlspecialchars($courier['courier_id']); ?>" <?php echo !$courier['status'] ? 'disabled' : ''; ?>>
                                select
                            </button>
                            <button class="btn-3 sc deselect-btn" type="button" style="display:none;"
                                data-courier="<?php echo htmlspecialchars($courier['courier_id']); ?>">
                                deselect
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="stat sh">
                <h1>Input Delivery Details</h1>
                <label>Selected Courier:</label>
                <span id="selectedCourierName"></span>
                <form id="addDeliveryForm" style="display:none;">
                    <label for="origin">Origin:</label>
                    <input type="text" name="origin" id="origin" required>
                    <label for="destination">Destination:</label>
                    <input type="text" name="destination" id="destination" required>
                    <label for="package_description">Description:</label>
                    <input type="text" name="package_description" id="package_description" required>
                    <label for="weight_kg">Weight (kg):</label>
                    <input type="number" name="weight_kg" id="weight_kg" required>
                    <label for="delivery_time_estimate">Time Estimate:</label>
                    <input type="text" name="delivery_time_estimate" id="delivery_time_estimate" required>
                    <input type="hidden" name="courier_id" id="courier_id" required>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo htmlspecialchars($user['id']); ?>"
                        required>
                    <button type="submit" class="btn-3 sc">Add Delivery</button>
                </form>
                <div id="deliveryResult"></div>
            </div>
        </div>
    </div>

<?php }, 'User dashboard', ['css' => $pageCss, 'js' => $pageJs]);

