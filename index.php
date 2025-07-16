<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';

// Include the head component
include TEMPLATES_PATH . '/head.component.php';
?>

<main>

    <?php include TEMPLATES_PATH . '/header.component.php'; ?>

    <div class="content">
        <h1 class="">
            MurimRun
        </h1>
        <p>
            Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem
            placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar
            vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc
            posuere.
            Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
            himenaeos.
        </p>
        <p>

            Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem
            placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar
            vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc
            posuere.
            Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
            himenaeos.
        </p>

        <div class="btn-actions">
            <a href="/pages/signupPage/index.php">
                <button class="btn">
                    Create Account
                </button>
            </a>
            <a href="/pages/loginPage/index.php">
                <button class="btn">
                    Log In
                </button>
            </a>
        </div>


    </div>


</main>

<!-- footer -->
<?php include TEMPLATES_PATH . '/footer.component.php'; ?>

</body>

</html>