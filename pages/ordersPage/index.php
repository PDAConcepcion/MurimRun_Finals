<?php
require_once LAYOUTS_PATH . '/main.layout.php';

$sects = require_once DUMMIES_PATH . '/sectcouriers.staticData.php';

$pageCss = [
    '/assets/css/style.css',
    'assets/css/orders.css'
];

renderMainLayout(function () use ($sects) { ?>
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
                    <!-- Loop through sects and display each as a selectable option -->
                    <?php foreach ($sects as $key => $sectDetail): ?>
                        <a href="" class="container" style="color: white;">
                            <div class="sect-photo">
                                <!-- sect photo here -->
                            </div>
                            <div class="sect-deets">
                                <!-- sect name here -->
                                <h3><?php echo $sectDetail['sectname'] ?></h3>
                            </div>
                        </a>
                    <?php endforeach ?>
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
<?php }, 'Hire A Courier', ['css' => $pageCss]);