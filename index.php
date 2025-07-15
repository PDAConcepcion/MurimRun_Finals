<?php

require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/header.css">


</head>

<body>

    <main>

        <!-- header -->
        <?php
        include TEMPLATES_PATH . '/header.component.php';
        ?>

        <div class="content">
            <h1 class="">
                MurimRum
            </h1>

            <div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                    pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed
                    diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl
                    malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad
                    litora torquent per conubia nostra inceptos himenaeos.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                    pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed
                    diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl
                    malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad
                    litora torquent per conubia nostra inceptos himenaeos.
                </p>
            </div>

        </div>

        <!-- footer -->
        <?php
        include TEMPLATES_PATH . '/footer.component.php';
        ?>
    </main>

</body>

</html>