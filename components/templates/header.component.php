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

    $navList = [
        ['label' => 'Orders', 'link' => 'pages/orders/index.php'],
        ['label' => 'Services', 'link' => 'pages/services/index.php'],
        ['label' => 'About Us', 'link' => 'pages/about-us/index.php'],
    ];
    ?>
    <header class="header-section">

        <div class="header-container">


            <div class="left-section">
                <h1>MurimRun</h1>
            </div>

            <div class="middle-section">
                <nav id="nav-menu" class="nav-bar">
                    <ul>
                        <?php foreach ($navList as $item): ?>
                            <li><a
                                    href="<?php echo htmlspecialchars($item['link']); ?>"><?php echo htmlspecialchars($item['label']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>

            <div class="right-section">
                <?php if (Auth::check() && $user): ?>
                    <!-- Show only Logout button if signed in -->
                    <!-- put the style in the css file -->
                    <div class="user-info" style="margin-right: 16px; text-align: right;">
                        <span><strong><?php echo htmlspecialchars($user['username']); ?></strong></span><br>
                        <span><?php echo htmlspecialchars($user['email']); ?></span><br>
                        <span style="font-size: 0.9em; color: #888;"><?php echo htmlspecialchars($user['role']); ?></span>
                    </div>
                    <a class="btn" href="<?php echo htmlspecialchars($rightButton['logoutLink']); ?>">
                        <?php echo htmlspecialchars($rightButton['logout']); ?>
                    </a>
                <?php else: ?>
                    <!-- Show Login and SignUp buttons if not signed in -->
                    <div class="btn-group">

                        <a class="btn btn-left" href="<?php echo htmlspecialchars($rightButton['loginLink']); ?>">
                            <?php echo htmlspecialchars($rightButton['login']); ?>
                        </a>
                        <a class="btn btn-right" href="<?php echo htmlspecialchars($rightButton['signupLink']); ?>">
                            <?php echo htmlspecialchars($rightButton['signup']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
<?php } ?>