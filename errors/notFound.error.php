<?php
http_response_code(404);

require_once LAYOUTS_PATH . '/main.layout.php';


$pageCss = [
    '/assets/css/style.css',
    '/assets/css/errors.css',
    '/assets/css/header.css',
    '/assets/css/footer.css'
];

renderMainLayout(function () {
    ?>

    <div class="background">
    </div>

    <section class="error-section">
        <div class="error-message">
            <h1>404</h1>
            <h2>Not Found</h2>
            <p>The page you are looking for doesn't exist!</p>
            <div class="action">

                <a href="/index.php" class="btn-2 back">Go Back</a>
            </div>

        </div>
    </section>


<?php }, 'Page Not Found', ['css' => $pageCss]) ?>