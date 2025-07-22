<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/sectCourier.util.php';
require_once UTILS_PATH . '/envSetter.util.php';

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
    '/assets/css/style.css',
    'assets/css/sectcourier.css'
];

$pageJs = [
    'assets/js/sectcourier.js'
];

renderMainLayout(function () use ($sectNames, $sectImage) { ?>
<div class="page">
    <!-- Background image and overlay -->
    <div class="background ims">
        <div class="overlay"></div>
    </div>

    <div class="order-section">
        <!-- Intro Section -->
        <div class="content start clr">
            <h1>Hire A Courier</h1>
            <p>
                <!-- Introductory text about the service -->
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida ex non lectus ullamcorper
                vestibulum. Suspendisse erat arcu, scelerisque aliquet dolor ac, pretium eleifend magna.
                Pellentesque quis tortor sagittis tellus iaculis semper. Nam luctus, odio id tincidunt vulputate,
                lectus velit commodo neque, non porttitor eros dui sit amet eros.
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida ex non lectus ullamcorper
                vestibulum. Suspendisse erat arcu, scelerisque aliquet dolor ac, pretium eleifend magna.
                Pellentesque quis tortor sagittis tellus iaculis semper. Nam luctus, odio id tincidunt vulputate,
                lectus velit commodo neque, non porttitor eros dui sit amet eros.
            </p>
            <div class="btn-group">
                <!-- Button to scroll to sect selection -->
                <a href="#sect-pick" class="btn">Get started</a>
            </div>
        </div>

        <!-- Choose a sect section -->
        <section class="content sc" id="sect-pick">
            <div class="content clr">
                <h1>Choose a SECT</h1>
                <div class="select-sect">
                    <?php for ($i = 0; $i < count($sectNames); $i++): ?>
                        <a href="" class="container" style="color: white;">
                            <div class="sect-deets">
                                <h3><?php echo htmlspecialchars($sectNames[$i]); ?></h3>
                            </div>
                            <div class="sect-photo">
                                <img src="<?php echo $sectImage[$i] ?? ''; ?>" alt="<?php echo htmlspecialchars($sectNames[$i]); ?>">
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>
                <p>
                    <!-- Additional info about sect selection -->
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida ex non lectus ullamcorper
                    vestibulum. Suspendisse erat arcu, scelerisque aliquet dolor ac, pretium eleifend magna.
                    Pellentesque quis tortor sagittis tellus iaculis semper. Nam luctus, odio id tincidunt vulputate,
                    lectus velit commodo neque, non porttitor eros dui sit amet eros.
                </p>
            </div>
            <div class="promises wh">
                <!-- Features/Promises Section -->
                <h1>⚔️ Disciplined Delivery, the Murim Way</h1>
                <p>
                    Like a trained martial artist, every MurimRunner moves with purpose—no delays, no detours. Your
                    package is treated with the same discipline and focus as a warrior’s mission.
                </p>
                <h1>🛡️ Secured From Start to Finish</h1>
                <p>
                    From pickup to handoff, your item is protected. MurimRun enforces a strict no-tampering policy, and
                    our runners uphold a code of honor, ensuring every delivery is safe and intact.
                </p>
                <h1>🌀 Swift as the Wind</h1>
                <p>
                    We don’t just deliver fast—we deliver with intent. MurimRun uses optimized routes and sharp timing,
                    making sure your delivery arrives exactly when it’s expected (or sooner).
                </p>
                <h1>🧭 Honest Tracking, No Hidden Paths</h1>
                <p>
                    Like a warrior’s open scroll, your delivery’s journey is transparent. You’ll always know where your
                    item is, with real-time updates from dispatch to doorstep.
                </p>
            </div>
        </section>
    </div>
</div>

<?php }, 'Hire A Courier', ['css' => $pageCss, 'js' => $pageJs]); ?>