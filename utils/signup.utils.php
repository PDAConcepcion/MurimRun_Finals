<?php
declare(strict_types=1);

include_once UTILS_PATH . '/envSetter.util.php';

class Signup
{
    /**
     * Validate the raw input; returns an array of error messages (empty if valid)
     *
     * @param array $data  Expecting keys: first_name, middle_name, last_name, username, password, role
     * @return string[]    List of validation errors
     */
    public static function validate(array $data): array
    {
        $errors = [];

        // Trim all inputs once
        $first_name = trim($data['first_name'] ?? '');
        $last_name = trim($data['last_name'] ?? '');
        $username = trim($data['username'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirm_password = $data['confirm_password'] ?? '';
        $role = trim($data['role'] ?? '');


        // 1) Required fields
        if ($first_name === '') {
            $errors[] = 'First name is required.';
        }
        if ($last_name === '') {
            $errors[] = 'Last name is required.';
        }
        if ($username === '') {
            $errors[] = 'Username is required.';
        }
        if ($email === '') {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }


        // 2) Role must be valid
        $validRoles = ['user', 'courier', 'admin']; // Updated roles for delivery app
        if (!in_array($role, $validRoles, true)) {
            $errors[] = 'Role must be "user", "courier", or "admin".';
        }

        // 3) Password policy
        $pwLen = strlen($password);
        if (
            $pwLen < 8
            || !preg_match('/[A-Z]/', $password)
            || !preg_match('/[a-z]/', $password)
            || !preg_match('/\d/', $password)
            || !preg_match('/\W/', $password)
        ) {
            $errors[] = 'Password must be at least 8 characters and include uppercase, lowercase, number, and special character.';
        }

        // 4) Password confirmation
        if ($password !== $confirm_password) {
            $errors[] = 'Passwords do not match.';
        }

        return $errors;
    }

    /**
     * Create the user in the database. Throws on error.
     *
     * @param PDO   $pdo
     * @param array $data  Same keys as validate()
     * @return void
     * @throws PDOException on SQL errors (including duplicate username)
     */
    public static function create(PDO $pdo, array $data): void
    {
        // Prepare insert - Fixed table name and columns to match User_table.sql
        $stmt = $pdo->prepare("
            INSERT INTO public.\"User_table\"
              (username, password, first_name, last_name, role, email)
            VALUES
              (:username, :password, :first_name, :last_name, :role, :email)
        ");

        // Hash password
        $hashed = password_hash($data['password'], PASSWORD_DEFAULT);

        // Bind and execute
        $stmt->execute([
            ':username' => trim($data['username']),
            ':password' => $hashed,
            ':first_name' => trim($data['first_name']),
            ':last_name' => trim($data['last_name']),
            ':role' => trim($data['role']),
            ':email' => trim($data['email']), // Added email field
        ]);
    }
}