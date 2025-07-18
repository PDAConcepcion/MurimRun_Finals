<?php 
declare(strict_types=1);
include_once UTILS_PATH . '/userView.utils.php';

class userDatabase
{
    /**
     * View all users in the database.
     *
     * @param PDO $pdo The PDO connection to the database.
     * @return array|false Returns an array of users or false on failure.
     */
    public static function ViewAll(PDO $pdo)
    {
        try {
            
            $stmt = $pdo->query('SELECT * FROM public."User_table" ORDER BY last_name, first_name');
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;

        } catch (PDOException $e) {
            // Log any SQL errors
            error_log('[userDatabase::ViewAll] PDOException: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * View a user by email.
     *
     * @param PDO $pdo The PDO connection to the database.
     * @param string $email The email of the user to view.
     * @return array|false Returns an associative array of user data or false on failure.
     */

    public static function ViewByEmail(PDO $pdo, string $email)
    {
        $stmt = $pdo->prepare('
            SELECT * FROM public."User_table"
            WHERE email = :email
        ');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update user information by email.
     *
     * @param PDO $pdo The PDO connection to the database.
     * @param string $email The email of the user to update.
     * @param array $data The data to update.
     * @return bool Returns true on success, false on failure.
     */
    public static function updateByEmail(PDO $pdo, string $email, array $data): bool
    {
    $stmt = $pdo->prepare('
        UPDATE public."User_table"
        SET first_name = :first_name,
            last_name = :last_name,
            username = :username,
            role = :role
        WHERE email = :email
    ');
    return $stmt->execute([
        ':first_name' => $data['first_name'],
        ':last_name' => $data['last_name'],
        ':username' => $data['username'],
        ':role' => $data['role'],
        ':email' => $email,
    ]);
    }
}
 ?>