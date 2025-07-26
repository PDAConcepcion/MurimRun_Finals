<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/sectCourier.util.php';
require_once UTILS_PATH . '/envSetter.util.php';

$mongoCheckerResult = require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
$postgresCheckerResult = require_once HANDLERS_PATH . '/postgreChecker.handler.php';

// Setup DB connection
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$couriers = SectCouriers::getAll($pdo);

$sectNames = array_values(array_unique(array_filter(array_map(
    fn($courier) => $courier['sectname'] ?? null,
    $couriers
))));

$sectImage = [
    '../../assets/img/Vermilion_Bird_Sect.png',
    '../../assets/img/White_Tiger_Sect.png',
    '../../assets/img/Black_turtiose_Sect.png',
    '../../assets/img/Azure_Dragon_Sect.png',
];


$pageCss = [
    '../../assets/css/style.css',
    'assets/css/sectcourier.css',
    '../../assets/css/footer.css',
    '../../assets/css/header.css'
];

$pageJs = [
    'assets/js/sectcourier.js'
];

renderMainLayout(function () use ($sectNames, $sectImage) { ?>
    <!-- Background image and overlay -->
    <div class="background ims">
        <div class="overlay"></div>
    </div>

    <section class="page">

        <h1 class="hero-head">Not Just Couriers, Disciples of Delivery.
        </h1>
        <p class="hero-desc">
            At MurimRun, your package isn’t just handled — it’s honored.
        </p>
        <div class="btn-group">
            <!-- Button to scroll to sect selection -->
            <a href="#sect-pick" class="btn">Get started</a>
        </div>

    </section>

    <!-- Choose a sect section -->
    <section class="sect-feature" id="sect-pick">

        <h1 class="hero-head">Pick a SECT</h1>
        <div class="select-sect">
            <?php for ($i = 0; $i < count($sectNames); $i++): ?>
                <a href="" class="container" style="color: white;">
                    <div class="sect-photo">
                        <img src="<?php echo $sectImage[$i] ?? ''; ?>" alt="<?php echo htmlspecialchars($sectNames[$i]); ?>">
                    </div>
                    <div class="sect-deets">
                        <h3><?php echo htmlspecialchars($sectNames[$i]); ?></h3>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
        <p class="sect-desc">
            <!-- Additional info about sect selection -->
            Choose from our elite sects, each trained in their own unique delivery style. Whether you value speed, stealth,
            or strength, there’s a sect ready to carry your mission with precision and pride.
        </p>
    </section>

    <!-- Features/Promises Section -->
    <section class="pageContainer">
        <div class="murim-way">

            <div class="promises-left">
                <h1>Our Pillars of Service</h1>
                <hr class="divider">
                <h1>⚔️ Disciplined Delivery, the Murim Way</h1>
                <p class="murimHead">
                    Every MurimRunner moves with purpose. No delays, no detours.
                </p>
                <p class="murimDesc">
                    Your package is treated with the same discipline and focus as a warrior’s mission.

                </p>
            </div>

            <div class="promises-right mrp">
                <img src="/assets/img/courier-1.png" alt="">
            </div>

        </div>

        <div class="murim-way">
            <div class="promises-left">

            </div>
            <div class="promises-right">
                <h1>🛡️ Secured From Start to Finish</h1>
                <p class="murimHead">
                    From pickup to handoff, your item is protected.
                </p>
                <p class="murimDesc">
                    MurimRun enforces a strict no-tampering policy, and
                    our runners uphold a code of honor, ensuring every delivery is safe and intact.
                </p>
            </div>
        </div>
        <div class="murim-way">
            <div class="promises-left">
                <h1>🌀 Swift as the Wind</h1>
                <p class="murimHead">
                    We don’t just deliver fast—we deliver with intent.
                </p>
                <p class="murimDesc">
                    MurimRun uses optimized routes and sharp timing,
                    making sure your delivery arrives exactly when it’s expected (or sooner).
                </p>
            </div>
            <div class="promises-right">

            </div>
        </div>

        <div class="murim-way">
            <div class="promises-left">

            </div>
            <div class="promises-right">
                <h1>🧭 Honest Tracking, No Hidden Paths</h1>
                <p class="murimHead">
                    Like a warrior’s open scroll, your delivery’s journey is transparent.
                </p>
                <p class="murimDesc">
                    You’ll always know where your
                    item is, with real-time updates from dispatch to doorstep.
                </p>

            </div>
        </div>

    </section>

<?php }, 'Hire A Courier', ['css' => $pageCss, 'js' => $pageJs]); ?>