<?php
require_once LAYOUTS_PATH . '/main.layout.php';

$courierInfo = require_once DUMMIES_PATH . '/deliveries.staticData.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>
    <main>

        <section class="courier-section">
            <?php foreach ($courierInfo as $courier): ?>
                <div class="courier-container">

                    <div class="courier-photo">
                        <img src="" alt="profile photo">
                    </div>

                    <div class="courier-details">
                        <div>
                            <h3>Status: </h3>
                            <p>Origin: </p>
                            <p>Destination: </p>
                            <p>Package description: </p>
                            <p>Weight: </p>

                        </div>
                        <div>
                            <h3><?php echo $courier['status']; ?></h3>
                            <p><?php echo $courier['origin']; ?></p>
                            <p><?php echo $courier['destination']; ?></p>
                            <p><?php echo $courier['packagedescription']; ?></p>
                            <p><?php echo $courier['weight_kg']; ?> kg</p>

                        </div>

                        <div class="button-container">
                            <a class="btn-2" href="">Show more >>></a>
                        </div>
                    </div>

                </div>
                <?php
            endforeach;
            ?>
        </section>

    </main>

</body>

</html>