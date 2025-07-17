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
}
 ?>