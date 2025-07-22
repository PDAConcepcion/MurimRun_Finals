<?php

require_once TEMPLATES_PATH . '/header.component.php';
$users = require_once DUMMIES_PATH . '/users.staticData.php';

navHeader()
    ?>

<link rel="stylesheet" href="assets/css/adminDashboard.css">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/header.css">



<div class="page admin">

    <div class="overlay"></div>

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
                <label for="categorySelect"><strong>Choose a category:</strong></label>
                <select id="categorySelect" onchange="showCategory(this.value)">
                    <option value="">-- Select --</option>
                    <option value="users">Registered Users</option>
                    <option value="deliveries">Ongoing Deliveries</option>
                </select>
            </div>

            <div class="db-table">
                <table id="users" cellpadding="2" class="table-area" style="display: none">
                    <thead>
                        <tr>
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




        <!-- <div class="courier-tab rnd-tab">

            <div class="courier-total vr al">
                <p class="tag">Total Couriers </p>
                <p class="result tn">51</p>
            </div>
            <div class="courier-available vr al">
                <p class="tag">Available Couriers</p>
                <p class="result av">24</p>

            </div>
            <div class="courier-ongoing al">
                <p class="tag">Ongoing Deliveries</p>
                <p class="result og">27</p>

            </div>
        </div>

        <div class="deliveries-users">
            <div class="delivery-stat left-box rnd-tab al">
                <p class="tag">Total Deliveries</p>
                <p class="result td">13</p>

            </div>

            <div class="user-stat right-box rnd-tab al us">
                <p class="tag">Total Users Registered</p>
                <p class="result us">18</p>

            </div>
        </div> -->

    </div>


</div>

<script src="assets/js/adminDashboard.js"></script>