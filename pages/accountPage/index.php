<?php
// Includes the header.
require_once __DIR__ . '/../../components/templates/header.component.php';

$user = [
    'username' => 'li hua',
    'first_name' => 'li',
    'last_name' => 'hua',
    'password' => 'ILOVECULTIVATION',
    'email' => 'CHinese111@gmail.com',
    'role' => 'warrior',
];

$order = [
    'origin' => 'Central Warehouse',
    'destination' => 'Mount Hua Sect',
    'package_description' => 'Herbs Shipment',
    'weight_kg' => '25kg',
    'status' => 'In Transit',
    'delivery_time_estimate' => '2 days',

];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - MurimRun</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/accountPage.css">
</head>

<body>

    <div class="account-page">
        <section class=info-section>

            <div class="user-section">

                <div class="user-top">
                    <h2>User Profile</h2>
                    <?php foreach ($user as $key => $userInfo): ?>
                        <?php if ($key === 'password')
                            continue; ?>
                        <div class="user-info">
                            <p><strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?>: </strong>
                                <?php echo htmlspecialchars($userInfo); ?></p>

                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="user-bottom">
                    <button class="btn"><a href="index.php">Edit Profile</a></button>
                </div>

            </div>



            <div class="courier-section">
                <div class="courier-left">
                    <h2>Courier Info</h2>
                    <?php foreach ($order as $key => $orderInfo): ?>
                        <div class="order-card">
                            <p><strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?></strong></p>
                            <div class="order-info">
                                <p><?php echo htmlspecialchars($orderInfo); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="courier-left-bottom">
                        <button class="btn"><a href="index.php">Cancel Delivery</a></button>
                    </div>
                </div>

                <div class="courier-right">
                    <div class="courier-right-top">

                        <img src="/assets/img/martial-arts-2400.jpg" alt="">
                        <h2 class="packageId">Package ID: </h2>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- <div class="account-page">
        <div class="form-container">
            <h1>Account Settings</h1>

            <form action="../../handlers/updateUsername.handler.php" class="account-form" method="POST">
                <h2>Change Username</h2>
                <div class="form-group">
                    <label for="currentUsername">Current Username</label>
                    <input type="text" id="currentUsername" name="currentUsername" value="user_placeholder" disabled>
                </div>
                <div class="form-group">
                    <label for="newUsername">New Username</label>
                    <input type="text" id="newUsername" name="newUsername" placeholder="Enter your new username"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Save Username</button>
            </form>

            ' tags.
            -->
    </div>
    </div> -->
    <?php
    // Includes the footer.
    require_once __DIR__ . '/../../components/templates/footer.component.php';
    ?>
    <script src="assets/js/accountPage.js"></script>
</body>

</html>