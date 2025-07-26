<?php
http_response_code(403);

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
            <h1>403</h1>
            <h2>Forbidden</h2>
            <p>You don't have permission to access / on this server.</p>
            <div class="action">

                <a href="/index.php" class="btn-2 back">Go Back</a>
            </div>

        </div>
    </section>



<?php }, 'Forbidden', ['css' => $pageCss]) ?>