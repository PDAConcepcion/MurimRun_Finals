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
    <div class="signup-container">
        <h1 class="signup-title">Create Your Account</h1>
        <p class="signup-subtitle">Join the adventure with MurimRun!</p>

        <?php if (!empty($errors)): ?>
            <div class="error-message" style="color: #dc3545; margin-bottom: 15px;">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

<form action="../../handlers/signup.handler.php" method="POST" class="signup-form">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="e.g., Juan dela Cruz" required
                    value="<?php echo htmlspecialchars(($old['first_name'] ?? '') . ' ' . ($old['last_name'] ?? '')); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required
                    value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
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
<?php }, 'Sign Up', ['css' => $pageCss, 'js' => $pageJs]);