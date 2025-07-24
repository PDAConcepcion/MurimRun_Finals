<?php
declare(strict_types=1);

require_once UTILS_PATH . '/auth.utils.php';

function navHeader(array $user = null): void
{
    $rightButton = [
        'login' => 'Login',
        'loginLink' => '/pages/loginPage/index.php',
        'signup' => 'SignUp',
        'signupLink' => '/pages/signupPage/index.php',
        'logout' => 'Logout',
        'logoutLink' => '/handlers/auth.handlers.php?action=logout'
    ];

    // Nav links for guests
    $guestNavList = [
        ['label' => 'Services', 'link' => '/pages/services/index.php'],
        ['label' => 'About Us', 'link' => '/pages/about-us/index.php'],
    ];

    $userNavList = [
        ['label' => 'My Account', 'link' => '/pages/accountPage/index.php'],
        ['label' => 'Orders', 'link' => '/pages/dashboard/index.php'],
        ['label' => 'Services', 'link' => '/pages/ordersPage/index.php'],
        ['label' => 'About Us', 'link' => '/pages/about-us/index.php'],
        ['label' => 'Dashboard', 'link' => '/pages/adminDashboardPage/index.php']

    ];


    $currentPath = $_SERVER['REQUEST_URI'];

    $hideButtonsPages = [
        '/pages/loginPage/index.php',
        '/pages/signupPage/index.php'
    ];

    $navList = (Auth::check() && $user) ? $userNavList : $guestNavList;
    ?>
    <header class="header-section">
        <div class="header-container">

            <!-- Left: Logo -->
            <div class="left-section navbar">

                <!-- hamburger section for smaller screens -->

                <div class="hamburger" id="hamburger">
                    ☰
                </div>

                <div class="mobile-nav" id="mobileNav">
                    <?php if (Auth::check() && $user): ?>
                        <div class="user-left">

                            <div class="user-mobile dp">
                                <img src="/assets/img/user-icon.png" alt="">

                            </div>

                            <div class="user-info">
                                <span class="username">
                                    <strong>Hello, <?php echo htmlspecialchars($user['username']); ?></strong></span><br>
                                <span class="email"><?php echo htmlspecialchars($user['email']); ?></span><br>
                                <span class="role">
                                    <?php echo htmlspecialchars($user['role']); ?>
                                </span>
                            </div>

                        </div>
                    <?php endif; ?>

                    <?php foreach ($navList as $item): ?>
                        <a class="nav-item" href="<?php echo htmlspecialchars($item['link']); ?>">
                            <?php echo htmlspecialchars($item['label']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="logo-box">
                    <a href="/index.php">MurimRun</a>
                </div>
                <nav class="nav-btn">
                    <?php foreach ($navList as $item): ?>
                        <a class="btn-4 und" href="<?php echo htmlspecialchars($item['link']); ?>">
                            <?php echo htmlspecialchars($item['label']); ?>
                        </a>
                    <?php endforeach; ?>
                </nav>

            </div>



            <!-- Right: User Info or Auth Buttons -->
            <div class="right-section">
                <?php if (Auth::check() && $user): ?>
                    <!-- User Info and Logout -->
                    <div class="user-login user-right">
                        <span class="username">
                            <strong>Hello, <?php echo htmlspecialchars($user['username']); ?></strong></span><br>
                        <span class="email"><?php echo htmlspecialchars($user['email']); ?></span><br>
                        <span class="role">
                            <?php echo htmlspecialchars($user['role']); ?>
                        </span>
                    </div>
                    <div class="user-web dp">
                        <img src="/assets/img/user-icon.png" alt="">
                    </div>
                    <a class="btn-5" href="<?php echo htmlspecialchars($rightButton['logoutLink']); ?>">
                        <?php echo htmlspecialchars($rightButton['logout']); ?>
                    </a>
                <?php else: ?>

                    <?php if (!in_array($currentPath, $hideButtonsPages)): ?>
                        <!-- Login and SignUp Buttons -->
                        <div class="btn-group">
                            <a class="btn btn-left" href="<?php echo htmlspecialchars($rightButton['loginLink']); ?>">
                                <?php echo htmlspecialchars($rightButton['login']); ?>
                            </a>
                            <a class="btn btn-right" href="<?php echo htmlspecialchars($rightButton['signupLink']); ?>">
                                <?php echo htmlspecialchars($rightButton['signup']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
            </div>

        </div>
    </header>
<?php } ?>