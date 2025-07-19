<?php
require_once LAYOUTS_PATH . '/main.layout.php';


$sectCouriers = require DUMMIES_PATH . '/sectcouriers.staticData.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User dashboard</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<div class="page user">
    <div class="overlay"></div>

    <div class="dashboard">
        <div class="head-title">
            <h1 class="head-text">Dashboard</h1>
            <p class="time-text"><?php echo date("D, M j Y") ?></p>

        </div>
        <div class="user-dash">
            <div class="courier-pick">

                <?php foreach ($sectCouriers as $courier): ?>
                    <div class="courier-container sh">
                        <div class="courier-img"></div>
                        <div class="info-block">
                            <div class="info-type">
                                <p class="info">Name: </p>
                                <p class="info">Sect: </p>
                                <p class="info">Rank: </p>
                                <p class="info">Speed rating: </p>
                                <p class="info">Status: </p>
                            </div>

                            <div class="info-result">
                                <p class="info"><strong><?php echo $courier['name'] ?></strong></p>
                                <p class="info"><strong><?php echo $courier['sectname'] ?></strong></p>
                                <p class="info"><strong><?php echo $courier['rank'] ?></strong></p>
                                <p class="info"><strong><?php echo $courier['speedrating'] ?></strong></p>
                                <p class="info"><strong><?php echo $courier['status'] ?></strong></p>

                            </div>


                        </div>
                        <div class="choice">

                            <a class="btn-3 sc" href="">select</a>
                        </div>

                    </div>
                    <?php
                endforeach
                ?>
            </div>
            <div class="stat sh">
                <h1>side</h1>
            </div>

            <!-- end foreach -->
        </div>
    </div>
</div>





</html>