<?php
require_once LAYOUTS_PATH . '/main.layout.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/user.utils.php';

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
$user = Auth::user();

if (!$user) {
    header('Location: /pages/loginPage/index.php');
    exit;
}

$pageCss = [
    '../../assets/css/header.css',
    '../../assets/css/footer.css',
    '../../assets/css/style.css',
    'assets/css/accountPage.css'
];

renderMainLayout(function () use ($user) { ?>
<div class="account-page">
    <section class="info-section">

        <!-- User Profile Section -->
        <div class="user-section">
            <div class="user-top">
                <h2>User Profile</h2>
                <?php foreach ($user as $key => $userInfo): ?>
                    <?php if ($key === 'password') continue; // Hide password ?>
                    <div class="user-info">
                        <p>
                            <strong>
                                <?php echo ucfirst(str_replace('_', ' ', $key)); ?>:
                            </strong>
                            <?php echo htmlspecialchars($userInfo); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="user-bottom">
                <button class="btn">
                    <a href="index.php">Edit Profile</a>
                </button>
            </div>
        </div>

    </section>
</div>
<?php
}, 'Account Page', ['css' => $pageCss]);
?>


    <!-- <div class="account-page">
        <div class="form-container">
            <h1>Account Settings</h1>

            <form action="../../handlers/updateUsername.handler.php" class="account-form" method="POST">
                <h2>Change Username</h2>
                <div class="form-group">
                    <label for="currentUsername">Current Username</label>
                    <input type="text" id="currentUsername" name="currentUsername" value="user_placeholder" disabled>
                </div>
                <div class="form-group">
                    <label for="newUsername">New Username</label>
                    <input type="text" id="newUsername" name="newUsername" placeholder="Enter your new username"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Save Username</button>
            </form> -->