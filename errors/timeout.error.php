<?php
http_response_code(408);

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
            <h1>408</h1>
            <h2>Request Timeout</h2>
            <p>The client took too long to send a request.</p>

            <div class="action">

                <a href="/index.php" class="btn-2 back">Go Back</a>
            </div>
        </div>
    </section>

<?php }, 'Request Timeout', ['css' => $pageCss]) ?>