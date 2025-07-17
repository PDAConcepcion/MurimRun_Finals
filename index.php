<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';

require_once LAYOUTS_PATH . '/main.layout.php';

$pageCss = [
    '/assets/css/style.css',
    '/assets/css/header.css',
    '/assets/css/footer.css'
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
    <div class="content">
        <div class="intro-background">
            <img src="/assets/img/martial-arts-2400.jpg" alt="MurimRun Background" />
            <div class="overlay"></div>
            <div class="intro-container">
                <h1 class="">MurimRun</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque
                    faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi
                    pretium tellus duis convallis. Tempus leo eu aenean sed diam urna
                    tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas.
                    Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut
                    hendrerit semper vel class aptent taciti sociosqu. Ad litora
                    torquent per conubia nostra inceptos himenaeos.
                </p>
                <div class="btn-actions">
                    <a href="/pages/signupPage/index.php">
                        <button class="btn">Create Account</button>
                    </a>
                    <a href="/pages/loginPage/index.php">
                        <button class="btn">Log In</button>
                    </a>
                </div>
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
<?php }, 'MurimRun - Swift as the Blade!', ['css' => $pageCss]);