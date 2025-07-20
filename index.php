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

<?php }, 'MurimRun - Swift as the Blade!', ['css' => $pageCss]);