<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/htmlEscape.util.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . '/signup.utils.php';

// Start session so we can flash errors / old input
Auth::init();

// Build PDO
$host = 'host.docker.internal';
$port = $databases['pgPort'];
$dbUser = $databases['pgUser'];
$dbPass = $databases['pgPassword'];
$dbName = $databases['pgDB'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbName}";
$pdo = new PDO($dsn, $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]);

    // Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /pages/signup/index.php');
    exit;
}

// Collect processed input directly from POST
$input = [
    'first_name'        => $_POST['first_name'] ?? '',
    'last_name'         => $_POST['last_name'] ?? '',
    'username'          => $_POST['username'] ?? '',
    'email'             => $_POST['email'] ?? '',
    'password'          => $_POST['password'] ?? '',
    'confirm_password'  => $_POST['confirmPassword'] ?? '',
    'role'              => 'user', // Default role for new signups
];

// 1) Validate
$errors = Signup::validate($input);

if (count($errors) > 0) {
    $_SESSION['signup_errors'] = $errors;
    $_SESSION['signup_old'] = $input;
    header('Location: /pages/signupPage/index.php');
    exit;
}

// 2) Create user
try {
    Signup::create($pdo, $input);

} catch (PDOException $e) {
    // Duplicate username?
    if ($e->getCode() === '23505') {
        $_SESSION['signup_errors'] = ['Username already taken.'];
        $_SESSION['signup_old'] = $input;
        header('Location: /pages/signupPage/index.php');
        exit;
    }
    // Otherwise, fail hard
    error_log('[signup.handler] PDOException: ' . $e->getMessage());
    http_response_code(500);
    exit('Server error.');
}

// 3) Success — clear old flashes and redirect to login
unset($_SESSION['signup_errors'], $_SESSION['signup_old']);
header('Location: /pages/loginPage/index.php?message=Account%20created%20successfully');
exit;