<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';



require_once STATICDATAS_PATH . '/services.staticData.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MurimRun - Swift as the Blade!</title>

    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>

    <main>



        <div class="content">
            <div class="intro-background">
                <img src="assets/img/murimrun-bg-2.png" alt="MurimRun Background" />
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

    </main>



</body>


</html>