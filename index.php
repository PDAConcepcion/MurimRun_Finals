<?php
require_once LAYOUTS_PATH . '/main.layout.php';

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

    <div class="page">
        <div class="background ims">
            <div class="overlay"></div>
        </div>
        <div class="intro">
            <h1 class="head-text">MurimRun</h1>
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
            </div>
            <section class="cards">
                <?php foreach ($services as $info): ?>
                    <div class="card-container">
                        <div class="image-container">
                            <img src="" alt="">
                        </div>
                        <div class="description-container">
                            <h1><?php echo $info['service'] ?></h1>
                            <p><?php echo $info['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </section>
        </div>


    </div>
    </div>


<?php }, 'MurimRun - Swift as the Blade!', ['css' => $pageCss]);