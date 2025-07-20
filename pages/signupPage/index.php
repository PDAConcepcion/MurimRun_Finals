<?php

require_once LAYOUTS_PATH . '/main.layout.php';

$pageCss = [
    '../../assets/css/style.css',
    '/assets/css/header.css',
    '/assets/css/footer.css',
    'assets/css/signup.css'
];

$pageJs = [
    '/assets/js/signup.js'
];

$errors = $_SESSION['signup_errors'] ?? [];
$old = $_SESSION['signup_old'] ?? [];
unset($_SESSION['signup_errors'], $_SESSION['signup_old']); // Clear session data after use

renderMainLayout(function () use ($errors, $old) { ?>

    <div class="page">

        <div class="signup-section">


            <div class="form-container">
                <div class="logo-section">
                    <h2 class="signup-title">Create Your Account</h2>
                    <p class="signup-subtitle">Join MurimRun!</p>

                </div>

                <?php if (!empty($errors)): ?>
                    <div class="error-message" style="color: #dc3545; margin-bottom: 15px;">
                        <ul>
                            <?php foreach ($errors as $err): ?>
                                <li><?php echo htmlspecialchars($err); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="signup-field">
                    <form action="../../handlers/signup.handler.php" method="POST">
                        <label for="firstname">First Name </label>
                        <input type="text" name="first_name" id="first_name" required
                            value="<?php echo htmlspecialchars($old['first_name'] ?? ''); ?>">
                        <label for="lastname">Last Name </label>
                        <input type="text" name="last_name" id="last_name" required
                            value="<?php echo htmlspecialchars($old['last_name'] ?? ''); ?>">
                        <label for="email">Email </label>
                        <input type="email" name="email" id="email" required
                            value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
                        <label for="username">Username </label>
                        <input type="username" name="username" id="username" required
                            value="<?php echo htmlspecialchars($old['password'] ?? ''); ?>">
                        <label for="password">Password </label>
                        <input type="password" name="password" id="password" required
                            value="<?php echo htmlspecialchars($old['password'] ?? ''); ?>">
                        <label for="confirmPassword">Confirm Password </label>
                        <input type="password" name="confirmPassword" id="confirmPassword" required
                            value="<?php echo htmlspecialchars($old['confirmPassword'] ?? ''); ?>">
                        <span id="password-match-message" class="password-message"></span>

                        <a href="" class="btn">submit</a>

                    </form>
                    <div class="login-redirect">
                        <p>Already have an account? <a href="../loginPage/">Log In</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php }, 'Sign Up', ['css' => $pageCss, 'js' => $pageJs]);