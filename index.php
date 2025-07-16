<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';

// Include the head component
include TEMPLATES_PATH . '/head.component.php';

require_once STATICDATAS_PATH . '/services.staticData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MurimRun - Swift as the Blade!</title>

    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>

    <main>


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

    </main>


</body>


</html>