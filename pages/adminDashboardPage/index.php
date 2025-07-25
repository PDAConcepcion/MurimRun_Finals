<?php

require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/user.utils.php';
require_once UTILS_PATH . '/deliveries.util.php';
require_once UTILS_PATH . '/sectCourier.util.php';

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

$users = userDatabase::ViewAll($pdo);
$deliveries = Deliveries::getAll($pdo);
$couriers = SectCouriers::getAll($pdo);


$pageCss = [
    'assets/css/adminDashboard.css',
    '../../assets/css/header.css',
    '../../assets/css/footer.css',
    '../../assets/css/style.css'
];

$pageJs = [
    'assets/js/adminDashboard.js'
];

renderMainLayout(function () use ($users, $deliveries, $couriers) { ?>
<div class="page admin">
    <div class="container">
        <!-- Title Section -->
        <div class="title-section">
            <h1>Admin Dashboard</h1>
            <p class="time-text"><?php echo date("D, M j Y") ?></p>
        </div>

        <!-- Welcome Description -->
        <section class="description">
            <h3>Welcome, Master.</h3>
            <p>
                Within this dashboard lies the power to oversee your delivery sect with the precision of
                a seasoned warrior.
            </p>
        </section>

        <!-- Admin Database Section -->
        <section class="admin-db">
            <div class="d-head">
                <!-- Category Dropdown -->
                <div class="categories">
                    <label for="categorySelect"><strong>Choose a category:</strong></label>
                    <select id="categorySelect" onchange="showCategory(this.value)">
                        <option value="">-- Select --</option>
                        <option value="users">Users</option>
                        <option value="deliveries">Deliveries</option>
                        <option value="sectcouriers">Sect Couriers</option>
                    </select>
                </div>
                <!-- Action Buttons -->
                <div class="db-buttons">
                    <button id="addBtn" class="btn-5" title="Add to database">Add</button>
                    <button id="deleteBtn" class="btn-5" title="Delete from database">Delete</button>
                </div>
            </div>

            <div class="db-table">
                <!-- Users Table -->
                <table id="users" cellpadding="2" class="table-area" style="display: none">
                    <thead>
                        <tr>
                            <th style="display: none" class="select-header">
                                <input type="checkbox" id="selectAll" disabled>
                            </th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <?php if (strtolower($user['role']) !== 'admin'): ?>
                                <tr>
                                    <td style="display: none" class="select-cell">
                                        <input type="checkbox" name="selected_users[]"
                                            value="<?= htmlspecialchars($user['username']) ?>" disabled>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Deliveries Table -->
                <table id="deliveries" cellpadding="2" class="table-area" style="display: none">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Courier ID</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>ETA</th>
                            <th>Weight (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deliveries as $delivery): ?>
                            <tr>
                                <td><?= htmlspecialchars($delivery['delivery_id']) ?></td>
                                <td><?= htmlspecialchars($delivery['user_id']) ?></td>
                                <td><?= htmlspecialchars($delivery['courier_id']) ?></td>
                                <td><?= htmlspecialchars($delivery['origin']) ?></td>
                                <td><?= htmlspecialchars($delivery['destination']) ?></td>
                                <td><?= htmlspecialchars($delivery['package_description']) ?></td>
                                <td><?= htmlspecialchars($delivery['status']) ?></td>
                                <td><?= htmlspecialchars($delivery['delivery_time_estimate']) ?></td>
                                <td><?= htmlspecialchars($delivery['weight_kg']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Sect Couriers Table -->
                <table id="sectcouriers" cellpadding="2" class="table-area" style="display: none">
                    <thead>
                        <tr>
                            <th>Courier ID</th>
                            <th>Name</th>
                            <th>Sect Name</th>
                            <th>Rank</th>
                            <th>Speed Rating</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($couriers as $courier): ?>
                            <tr>
                                <td><?= htmlspecialchars($courier['courier_id']) ?></td>
                                <td><?= htmlspecialchars($courier['name']) ?></td>
                                <td><?= htmlspecialchars($courier['sectname']) ?></td>
                                <td><?= htmlspecialchars($courier['rank']) ?></td>
                                <td><?= htmlspecialchars($courier['speedrating']) ?></td>
                                <td><?= htmlspecialchars($courier['status'] ? 'Available' : 'Unavailable') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<?php }, 'Admin Dashboard', ['css' => $pageCss, 'js' => $pageJs]);