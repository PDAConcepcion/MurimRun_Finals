<?php
declare(strict_types=1);
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/envSetter.util.php';

// Initialize session
Auth::init();

// Database connection details
$host = 'host.docker.internal';
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$email = $databases['pgEmail'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

//Connect to PostgreSQL
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$action = $_REQUEST['action'] ?? null;

// LOGIN
    if($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $usernameInput = trim($_POST['username'] ?? '');
        $passwordInput = trim($_POST['password'] ?? '');

        if(AUTH::login(pdo: $pdo, usernameOrEmail: $usernameOrEmailInput, password: $passwordInput)) 
        {
            $user = AUTH::user();
            

            if ($user['role'] == 'admin') {
                //empty for now will redirect to admin dashboard later
            } else {
                //default user dashboard
            }
            exit;
        }
        else
        {
            //will lead to error page invalid credentials
            exit;
        }
    }

    elseif ($action === 'logout') {
    Auth::init();
    Auth::logout();
    //will lead to logout page
    exit;
    }