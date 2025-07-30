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
        "description" => "Slice Through Waiting. Choose MurimRun.",
        "image" => "/assets/img/stock-images/murimrun-package.jpg",
    ],
    [
        "service" => "Realtime Tracking",
        "description" => "Track your package realtime",
        "image" => "/assets/img/stock-images/murimrun-tracking.jpg"
    ],
    [
        "service" => "24/7 Customer Support",
        "description" => "Talk to one of our agents",
        "image" => "/assets/img/stock-images/murimrun-cs.jpg"
    ]
];

renderMainLayout(function () use ($services) { ?>

    <div class="background ims">
        <div class="overlay"></div>
    </div>
    <div class="page landing">
        <div class="intro">
            <div class="murimrun-logo"><img src="/assets/img/murimrun-wordmark-white.png" alt=""></div>

            <p class="intro-text">
                MurimRun is a courier service where elite warriors from ancient sects deliver your packages with speed,
                honor, and precision.
                <strong>
                    Choose your courier. Track your scroll. Earn rewards.
                </strong>
            </p>


            <div class="actions">
                <?php
                $user = Auth::user();
                if (Auth::check()):
                    if (isset($user['role']) && strtolower($user['role']) === 'admin'): ?>
                        <a class="btn-2" href="/pages/adminDashboardPage/index.php">Get started (Admin)</a>
                    <?php else: ?>
                        <a class="btn-2" href="/pages/dashboard/index.php">Get started</a>
                    <?php endif;
                else: ?>
                    <div class="btn-group sh">
                        <a class="btn btn-left" href="/pages/signupPage/index.php">
                            Create Account
                        </a>
                        <a class="btn btn-right" href="/pages/loginPage/index.php">
                            Log In
                        </a>
                    </div>
                <?php endif; ?>
            </div>



        </div>
        <section class="cards">
            <?php foreach ($services as $info): ?>
                <div class="card-container scale-1">
                    <div class="image-container">
                        <img class="pic scale-2" src="<?php echo $info['image'] ?>" alt="">
                    </div>
                    <div class="description-container">
                        <h2><?php echo $info['service'] ?></h2>
                        <p><?php echo $info['description'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </section>



    </div>


<?php }, 'MurimRun - Swift as the Blade!', ['css' => $pageCss]);