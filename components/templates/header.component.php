<?php
require_once UTILS_PATH . '/auth.utils.php';

declare(strict_types=1);

    function navHeader(array $user = null): void
    {

    $rightButton = [
        'login' => 'Login',
        'loginLink' => '/pages/loginPage/index.php',
        'signup' => 'SignUp',
        'signupLink' => '/pages/signupPage/index.php',
        'logout' => 'Logout',
        'logoutLink' => '/handlers/logout.handler.php'
    ];

    $navList = [
        ['label' => 'Orders', 'link' => 'pages/orders/index.php'],
        ['label' => 'Services', 'link' => 'pages/services/index.php'],
        ['label' => 'About Us', 'link' => 'pages/about-us/index.php'],
    ];
    ?>
    <header class="header-container">

        <div class="left-section">
            <h1>MurimRun</h1>
        </div>

        <div class="middle-section">
            <nav id="nav-menu" class="nav-bar">
                <ul>
                    <?php foreach ($navList as $item): ?>
                        <li><a href="<?php echo htmlspecialchars($item['link']); ?>"><?php echo htmlspecialchars($item['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>

        <div class="right-section">
            <?php //if ($isSignedIn): ?>
                <!-- Show only Logout button if signed in -->
                <button class="logout-btn">
                    <a href="<?php echo htmlspecialchars($rightButton['logoutLink']); ?>">
                        <?php echo htmlspecialchars($rightButton['logout']); ?>
                    </a>
                </button>
            <?php //else: ?>
                <!-- Show Login and SignUp buttons if not signed in -->
                <button class="login-btn">
                    <a href="<?php echo htmlspecialchars($rightButton['loginLink']); ?>">
                        <?php echo htmlspecialchars($rightButton['login']); ?>
                    </a>
                </button>
                <button class="signup-btn">
                    <a href="<?php echo htmlspecialchars($rightButton['signupLink']); ?>">
                        <?php echo htmlspecialchars($rightButton['signup']); ?>
                    </a>
                </button>
            <?php //endif; ?>
        </div>
    </header>
<?php } ?>