<?php

require_once BASE_PATH . '/bootstrap.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MurimRun - Welcome!</title>

    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/landing.css">
</head>

<body>
    <main>

        <!-- header -->
        <?php
        include TEMPLATES_PATH . '/header.component.php';
        ?>

        <div class="content">
            <div class="intro-background">
                <img src="assets/img/martial-arts-2400.jpg" alt="MurimRun Background" />
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


            <!-- card section -->
            <section class="services-section">
                <h2>Our Services</h2>
                <div class="services-container">
                    <div class="service-card">
                        <h3>🚚 Fast Deliveries</h3>
                        <p>
                            We ensure your items reach their destination quickly and safely,
                            every time.
                        </p>
                    </div>

                    <div class="service-card">
                        <h3>📞 Customer Support</h3>
                        <p>
                            Our support team is ready to assist you 24/7 with any inquiries
                            or issues.
                        </p>
                    </div>

                    <div class="service-card">
                        <h3>📦 Real-Time Tracking</h3>
                        <p>
                            Track your deliveries in real-time so you know exactly where
                            your package is.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <?php
        include TEMPLATES_PATH . '/footer.component.php';
        ?>
    </main>
</body>

</html>