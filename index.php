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

    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">



</head>

<body>

    <!-- header -->
    <?php
    include TEMPLATES_PATH . '/header.component.php';
    ?>

    <main>


        <h1 class="">
            MurimRum
        </h1>
    </main>

    <!-- footer -->
    <?php
    include TEMPLATES_PATH . '/footer.component.php';
    ?>

</body>

</html>