<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';

// Include the head component
include TEMPLATES_PATH . '/head.component.php';
?>

<main>

    <?php include TEMPLATES_PATH . '/header.component.php'; ?>

    <h1 class="">
        MurimRun
    </h1>

</main>

<!-- footer -->
<?php include TEMPLATES_PATH . '/footer.component.php'; ?>

</body>

</html>