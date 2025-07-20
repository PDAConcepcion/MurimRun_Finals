<?php
declare(strict_types=1);
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.utils.php';
require_once UTILS_PATH . 'DBConnection.php';

// Initialize session
Auth::init();

// Database connection details
$pdo = DBConnection::getPDO();

$action = $_REQUEST['action'] ?? null;

// LOGIN
    if($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $usernameInput = trim($_POST['username'] ?? '');
        $passwordInput = trim($_POST['password'] ?? '');

        if (Auth::login($pdo, $usernameInput, $passwordInput)) {
            $user = Auth::user();

            if ($user['role'] == 'admin') {
                header('Location: /index.php'); // Admin dashboard
            } else {
                header('Location: /index.php'); // User dashboard
            }
            exit;
        }
        else
        {
            header('Location: /pages/loginPage/index.php?error=invalid_credential');
            exit;
        }
    }

    elseif ($action === 'logout') {
    Auth::init();
    Auth::logout();
    header('Location: /index.php');
    exit;
    }