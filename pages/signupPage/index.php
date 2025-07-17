<?php

require_once BASE_PATH . '/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MurimRun</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">


    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>

    <?php
    include TEMPLATES_PATH . '/header.component.php';
    ?>

    <main class="signup-page">
        <div class="signup-container">
            <h1 class="signup-title">Create Your Account</h1>
            <p class="signup-subtitle">Ship with MurimRun now!</p>

            <form action="../../handlers/signup.handler.php" method="POST" class="signup-form">

                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" id="userName" name="userName" placeholder="e.g., JuanDC123" required>
                </div>

                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="e.g., Juan" required>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" placeholder="e.g., Dela Cruz" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter a secure password" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        placeholder="Re-enter your password" required>
                    <span id="password-match-message" class="password-message"></span>
                </div>

                <button type="submit" class="btn btn-primary btn-signup">Sign Up</button>

            </form>

            <div class="login-redirect">
                <p>Already have an account? <a href="../loginPage/">Log In</a></p>
            </div>
        </div>
    </main>

    <?php
    require_once __DIR__ . '/../../components/templates/footer.component.php';
    ?>

    <script src="assets/js/signup.js"></script>

</body>

</html>