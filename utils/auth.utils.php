<?php
declare(strict_types=1);

include_once UTILS_PATH . "/envSetter.util.php";

class Auth
{
    /**
     * Initialize session if not already started
     * 
     * @return void
     */
    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Attempt login; returns true if successful
     * 
     * @param PDO       $pdo        Used to check for existing users
     * @param string    $usernameOrEmail   Key for user lookup
     * @param string    $password   User's password
     * @return bool                 True if login successful, false otherwise
     */
    public static function login(PDO $pdo, string $usernameOrEmail, string $password): bool
    {
        try {
            // 1) Fetch the user record
            $stmt = $pdo->prepare("
                SELECT
                userid,
                first_name,
                last_name,
                username,
                password,
                role,
                email
                FROM public.\"User_table\"
                WHERE username = :usernameOrEmail OR email = :usernameOrEmail
            ");
            $stmt->execute([':usernameOrEmail' => $usernameOrEmail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            // Log any SQL errors
            error_log('[Auth::login] PDOException: ' . $e->getMessage());
            return false;
        }

        // Debug output: did we get a row?
        if (!$user) {
            error_log("[Auth::login] No user found for username='{$usernameOrEmail}'");
            return false;
        } else {
            error_log('[Auth::login] Retrieved user: ' . var_export([
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ], true));
        }

        // 2) Verify password
        if (!password_verify($password, $user['password'])) {
            error_log("[Auth::login] Password mismatch for user_id={$user['id']}");
            return false;
        }

        // 3) Success: regenerate session & store user + role
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
        error_log("[Auth::login] Login successful for user_id={$user['id']}");

        return true;
    }
    /**
     * Attempt signup; returns true if successful
     * 
     * @param PDO       $pdo        Used to insert new user
     * @param string    $firstName  User's first name
     * @param string    $lastName   User's last name
     * @param string    $username   Desired username
     * @param string    $email      User's email address
     * @param string    $password   User's password
     * @return bool                 True if signup successful, false otherwise
     */

    public static function signup(PDO $pdo, string $firstName, string $lastName, string $username, string $email, string $password): bool
    {
        try {
            // 1) Check if username or email already exists
            $stmt = $pdo->prepare("
                SELECT userid FROM public.\"User_table\" 
                WHERE username = :username OR email = :email
            ");
            $stmt->execute([
                ':username' => $username,
                ':email' => $email
            ]);
            $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                error_log("[Auth::signup] Username or email already exists");
                return false;
            }

            // 2) Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // 3) Insert new user
            $stmt = $pdo->prepare("
                INSERT INTO public.\"User_table\" (first_name, last_name, username, email, password, role) 
                VALUES (:first_name, :last_name, :username, :email, :password, 'user')
            ");
            $stmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);

            error_log("[Auth::signup] User created successfully: {$username}");
            return true;

        } catch (\PDOException $e) {
            error_log('[Auth::signup] PDOException: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Returns the currently logged-in user, or null if not logged in
     * 
     * @return array|null   User data if logged in, null otherwise
     */
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Check if a user is logged in
     * 
     * @return bool True if logged in, false otherwise
     */
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Log out the current user
     * 
     * @return void
     */
    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}