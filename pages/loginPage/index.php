<?php
require_once LAYOUTS_PATH . '/main.layout.php';

$pageCss = [
        '/assets/css/header.css',
        '/assets/css/footer.css',
        'assets/css/login.css',
        '/assets/css/style.css'
    ];

Auth::init();

if(Auth::check()) {
    header('Location: /index.php');
    echo '<script>alert("User is already logged in, redirecting to index.php");</script>';
    exit;
}

$error = $_GET['error'] ?? '';
renderMainLayout(function () use ($error) { ?>
<div class="form-container">
        <div class="logo">
            <h2>LOGO HERE</h2>
        </div>
        <div class="login-field">
            <?php if ($error === 'invalid_credential'): ?>
                <div class="error-message" style="color: red; margin-bottom: 10px;">
                    Invalid username or password.
                </div>
            <?php endif; ?>

            <form action="../../handler/auth.handlers.php?action=login" method="post">
                <label for="username">Username or Email</label>
                <input type="text" name="username" id="username" placeholder="Enter Username or Email" required>

                <label for="username">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>

                <div>
                    <button class="btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php }, 'Log In', ['css' => $pageCss]);