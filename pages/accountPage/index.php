<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/user.utils.php';

$mongoCheckerResult = require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
$postgresCheckerResult = require_once HANDLERS_PATH . '/postgreChecker.handler.php';

// Setup DB connection
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

Auth::init();
$sessionUser = Auth::user();

if (!$sessionUser) {
    header('Location: /errors/forbidden.error.php');
    exit;
}

$user = userDatabase::getById($pdo, $sessionUser['id']);

$pageCss = [
    '../../assets/css/header.css',
    '../../assets/css/footer.css',
    '../../assets/css/style.css',
    'assets/css/accountPage.css'
];

$pageJs = [
    'assets/js/accountPage.js'
];

$editMode = isset($_GET['edit']) && $_GET['edit'] == '1';

renderMainLayout(function () use ($user, $editMode) { ?>
    <div class="page">
        <div class="account-section">
            <div class="title-section">
                <img src="/assets/img/murimrun-icons/murimrun-account.png" alt="">
                <h1>My Account</h1>
            </div>
            <section class="window">

                <div class="sidebar">
                    <h3>Account</h3>
                    <button class="side-button" onclick="showContent('profile')">User Profile</button>
                    <button class="side-button" onclick="showContent('orders')">Orders</button>

                    <h3>About</h3>
                    <button class="side-button" onclick="showContent('about')">Terms and Policies</button>

                </div>

                <div class="content">
                    <div class="info-section">
                        <!-- User Profile Section -->
                        <div id="profile" class="tab-content">
                            <div class="user-top">
                                <?php if ($editMode): ?>
                                    <h2>Edit Profile</h2>

                                    <form method="POST" action="../../handlers/user.handler.php?action=update">
                                        <input type="hidden" name="original_user"
                                            value="<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php foreach ($user as $key => $userInfo): ?>
                                            <?php if ($key === 'password' || $key === 'user_id' || $key === 'role'|| $key === 'createdat')
                                                continue; ?>
                                            <div class="user-info">
                                                <label>
                                                    <?php echo ucfirst(str_replace('_', ' ', $key)); ?>:
                                                    <input type="text" name="<?php echo htmlspecialchars($key); ?>"
                                                        value="<?php echo htmlspecialchars($userInfo ?? ''); ?>">
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="btn-group">

                                            <button type="submit" class="btn btn-left">Save</button>
                                            <a href="index.php" class="btn btn-right">Cancel</a>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <h2>User Profile</h2>

                                    <?php foreach ($user as $key => $userInfo): ?>
                                        <?php if ($key === 'password' || $key === 'user_id' || $key === 'role')
                                            continue; // Hide password ?>
                                        <div class="user-info">
                                            <p>
                                                <strong>
                                                    <?php echo ucfirst(str_replace('_', ' ', $key)); ?>:
                                                </strong>
                                                <?php echo htmlspecialchars($userInfo); ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="user-bottom">
                                <?php if (!$editMode): ?>
                                    <a class="btn btn-group" href="index.php?edit=1">Edit Profile</a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div id="orders" class="tab-content orders" style="display: none;">
                            <h2>Orders</h2>
                        </div>

                        <div id="about" class="tab-content about" style="display: none;">
                            <h2>MurimRun Terms and Conditions</h2>

                        </div>

                    </div>

                    <!-- Orders Section -->
                </div>

            </section>
        </div>
    </div>
    <?php
}, 'My Account', ['css' => $pageCss, 'js' => $pageJs]);
?>