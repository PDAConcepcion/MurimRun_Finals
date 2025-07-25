<?php

require_once LAYOUTS_PATH . '/main.layout.php';
$users = require_once DUMMIES_PATH . '/users.staticData.php';


$pageCss = [
    'assets/css/adminDashboard.css',
    '/assets/css/style.css',
    '/assets/css/header.css'
];

$pageJs = [
    'assets/js/adminDashboard.js'
];

renderMainLayout(function () use ($users) { ?>
    <div class="page admin">
        <div class="container">
            <div class="title-section">
                <h1>Admin Dashboard</h1>
                <p class="time-text"><?php echo date("D, M j Y") ?></p>
            </div>
            <section class="description">
                <h3>Welcome, Master.</h3>
                <p>Within this dashboard lies the power to oversee your delivery sect with the precision of
                    a seasoned warrior.</p>
            </section>
            <section class="admin-db">
                <div class="d-head">
                    <div class="categories">
                        <label for="categorySelect"><strong>Choose a category:</strong></label>
                        <select id="categorySelect" onchange="showCategory(this.value)">
                            <option value="">-- Select --</option>
                            <option value="users">Registered Users</option>
                            <option value="deliveries">Ongoing Deliveries</option>
                        </select>
                    </div>
                    <div class="db-buttons">
                        <button id="addBtn" class="btn-5" title="Add to database">Add</button>
                        <button id="deleteBtn" class="btn-5" title="Delete from database">Delete</button>
                    </div>
                </div>
                <div class="db-table">
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
                </div>
            </section>
        </div>
    </div>
<?php }, 'Admin Dashboard', ['css' => $pageCss, 'js' => $pageJs]);