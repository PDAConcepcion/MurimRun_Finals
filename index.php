<?php
require_once LAYOUTS_PATH . '/main.layout.php';

require_once UTILS_PATH . '/auth.utils.php';


$mongoCheckerResult = require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
$postgresCheckerResult = require_once HANDLERS_PATH . '/postgreChecker.handler.php';


$pageCss = [
    'assets/css/style.css',
    'assets/css/header.css',
    'assets/css/footer.css'
];

$services = [
    [
        "service" => "Courier Services",
        "description" => "Slice Through Waiting. Choose MurimRun."
    ],
    [
        "service" => "Realtime Tracking",
        "description" => "Track your package realtime"
    ],
    [
        "service" => "24/7 Customer Support",
        "description" => "Talk to one of our agents"
    ]
];

renderMainLayout(function () use ($services) { ?>

    <div class="background ims">
        <div class="overlay"></div>
    </div>
    <div class="page">
        <div class="intro">
            <div class="murimrun-logo"><img src="/assets/img/murimrun-wordmark-white.png" alt=""></div>
            <p class="intro-text">
                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque
                faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi
                pretium tellus duis convallis. Tempus leo eu aenean sed diam urna
                tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas.
                Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut
                hendrerit semper vel class aptent taciti sociosqu. Ad litora
                torquent per conubia nostra inceptos himenaeos.
            </p>

            <div class="actions">

                <div class="btn-group sh">
                    <a class="btn btn-left" href="/pages/signupPage/index.php">
                        Create Account
                    </a>
                    <a class="btn btn-right" href="/pages/loginPage/index.php">
                        Log In
                    </a>
                </div>

                <a class="btn-2 " href="/pages/dashboard/index.php">Get started</a>

            </div>



        </div>
        <section class="cards">
            <?php foreach ($services as $info): ?>
                <div class="card-container scale-1">
                    <div class="image-container">
                        <img class="pic scale-2" src="/assets/img/Vermilion_Bird_Sect.png" alt="">
                    </div>
                    <div class="description-container">
                        <h2><?php echo $info['service'] ?></h2>
                        <p><?php echo $info['description'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
        <section class="carousel">
            <div class="carousel-track">
                <img src="image1.jpg" class="carousel-image" alt="">
            </div>
            <button class="prev">‹</button>
            <button class="next">›</button>
        </section>


    </div>


<?php }, 'MurimRun - Swift as the Blade!', ['css' => $pageCss]);