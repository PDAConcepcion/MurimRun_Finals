<?php

require_once BASE_PATH . '/bootstrap.php';

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.utils.php';

Auth::init();

if(Auth::check()) {
    echo '<script>alert("User is already logged in, redirecting to index.php");</script>';
    header('Location: /index.php');
    exit;
}

$error = $_GET['error'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
<?php include TEMPLATES_PATH . '/header.component.php'; ?>

    <main>
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
    </main>


    <?php
    include TEMPLATES_PATH . '/footer.component.php';
    ?>

</body>

</html>