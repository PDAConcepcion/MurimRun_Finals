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
                    <button id="editBtn" class="btn-5" title="Edit selected row(s)" style="display:none;">Edit</button>
                    <button id="deleteBtn" class="btn-5" title="Delete from database" style="display:none;">Delete</button>
                </div>
            </div>

            <div class="db-table">
                <!-- Users Table -->
                <table id="users" cellpadding="2" class="table-area" style="display: none">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User ID</th>
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
                                    <td class="select-cell">
                                        <input type="checkbox" name="selected_users[]" value="<?= htmlspecialchars($user['user_id']) ?>">
                                    </td>
                                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
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
                            <th></th>
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
                                <td class="select-cell">
                                    <input type="checkbox" name="selected_deliveries[]" value="<?= htmlspecialchars($delivery['delivery_id']) ?>">
                                </td>
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
                            <th></th>
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
                                <td class="select-cell">
                                    <input type="checkbox" name="selected_couriers[]" value="<?= htmlspecialchars($courier['courier_id']) ?>">
                                </td>
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
                <!-- Edit Modal -->

                <div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:9999; align-items:center; justify-content:center;">
                    <div style="background:white; padding:24px; border-radius:8px; min-width:300px; max-width:90vw;">
                        <h2 id="editModalTitle">Edit</h2>
                        <form id="editForm">
                            <!-- User fields -->
                            <div class="edit-user-fields">
                                <input type="hidden" name="user_id" id="edit_user_id">
                                <label>Username: <input type="text" name="username" id="edit_username"></label><br>
                                <label>First Name: <input type="text" name="first_name" id="edit_first_name"></label><br>
                                <label>Last Name: <input type="text" name="last_name" id="edit_last_name"></label><br>
                                <label>Email: <input type="email" name="email" id="edit_email"></label><br>
                                <label>Role: <input type="text" name="role" id="edit_role"></label><br>
                            </div>
                            <!-- Sect Courier fields -->
                            <div class="edit-sectcourier-fields" style="display:none;">
                                <input type="hidden" name="courier_id" id="edit_courier_id">
                                <label>Name: <input type="text" name="name" id="edit_name"></label><br>
                                <label>Sect Name: <input type="text" name="sectname" id="edit_sectname"></label><br>
                                <label>Rank: <input type="text" name="rank" id="edit_rank"></label><br>
                                <label>Speed Rating: <input type="number" name="speedrating" id="edit_speedrating"></label><br>
                                <label>Status: 
                                    <select name="status" id="edit_status">
                                        <option value="true">Available</option>
                                        <option value="false">Unavailable</option>
                                    </select>
                                </label><br>
                            </div>
                            <!-- Delivery fields -->
                            <div class="edit-delivery-fields" style="display:none;">
                                <input type="hidden" name="delivery_id" id="edit_delivery_id">
                                <label>User ID: <input type="text" name="user_id" id="edit_delivery_user_id"></label><br>
                                <label>Courier ID: <input type="text" name="courier_id" id="edit_delivery_courier_id"></label><br>
                                <label>Origin: <input type="text" name="origin" id="edit_origin"></label><br>
                                <label>Destination: <input type="text" name="destination" id="edit_destination"></label><br>
                                <label>Description: <input type="text" name="package_description" id="edit_package_description"></label><br>
                                <label>Status: <input type="text" name="status" id="edit_delivery_status"></label><br>
                                <label>ETA: <input type="text" name="delivery_time_estimate" id="edit_delivery_time_estimate"></label><br>
                                <label>Weight (kg): <input type="number" name="weight_kg" id="edit_weight_kg"></label><br>
                            </div>
                            <button type="submit" class="btn-5">Save</button>
                            <button type="button" class="btn-5" id="editCancelBtn">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php }, 'Admin Dashboard', ['css' => $pageCss, 'js' => $pageJs]);