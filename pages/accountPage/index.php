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
$sessionUser = Auth::user();

if (!$sessionUser) {
    header('Location: /pages/loginPage/index.php');
    exit;
}

$user = userDatabase::getById($pdo, $sessionUser['id']);

$pageCss = [
    '../../assets/css/header.css',
    '../../assets/css/footer.css',
    '../../assets/css/style.css',
    'assets/css/accountPage.css'
];

$editMode = isset($_GET['edit']) && $_GET['edit'] == '1';

renderMainLayout(function () use ($user, $editMode) { ?>
<div class="account-page">
    <section class="info-section">

        <!-- User Profile Section -->
        <div class="user-section">
            <div class="user-top">
                <h2>User Profile</h2>
                <?php if ($editMode): ?>
                <form method="POST" action="../../handlers/user.handler.php?action=update">
                    <input type="hidden" name="original_user" value="<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>">
                    <?php foreach ($user as $key => $userInfo): ?>
                        <?php if ($key === 'password' || $key === 'user_id') continue; ?>
                        <div class="user-info">
                            <label>
                                <?php echo ucfirst(str_replace('_', ' ', $key)); ?>:
                                <input type="text" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($userInfo ?? ''); ?>">
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            <?php else: ?>
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
                <?php endif; ?>
            </div>
            <div class="user-bottom">
                <?php if (!$editMode): ?>
                    <button class="btn">
                        <a href="index.php?edit=1">Edit Profile</a>
                    </button>
                <?php endif; ?>
            </div>
        </div>

    </section>
</div>
<?php
}, 'Account Page', ['css' => $pageCss]);
?>