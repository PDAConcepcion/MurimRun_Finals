<?php 
declare(strict_types=1);

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
     * Get a user by user_id.
     *
     * @param PDO $pdo
     * @param string $user_id
     * @return array|false Returns user data as an associative array or false on failure.
     */
    public static function getById(PDO $pdo, string $user_id)
    {
        try {
            $stmt = $pdo->prepare('SELECT * FROM public."User_table" WHERE user_id = :user_id LIMIT 1');
            $stmt->execute([':user_id' => $user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: false;
        } catch (PDOException $e) {
            error_log('[userDatabase::getById] PDOException: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Remove a user by user_id.
     * @param PDO $pdo
     * @param string $user_id
     * @return bool
     */
    public static function removeById(PDO $pdo, string $user_id): bool
    {
        $stmt = $pdo->prepare('DELETE FROM public."User_table" WHERE user_id = :user_id');
        return $stmt->execute([':user_id' => $user_id]);
    }

    /**
     * Update a user by user_id.
     *
     * @param PDO $pdo
     * @param string $user_id
     * @param array $data (keys: username, first_name, last_name, email, role, [password])
     * @return bool
     */
    public static function updateById(PDO $pdo, string $user_id, array $data): bool
    {
        $fields = [
            'username'   => ':username',
            'first_name' => ':first_name',
            'last_name'  => ':last_name',
            'email'      => ':email',
            'role'       => ':role'
        ];

        $params = [
            ':username'   => $data['username'],
            ':first_name' => $data['first_name'],
            ':last_name'  => $data['last_name'],
            ':email'      => $data['email'],
            ':role'       => $data['role'],
            ':user_id'    => $user_id
        ];

        $set = [];
        foreach ($fields as $col => $ph) {
            $set[] = "\"$col\" = $ph";
        }

        // Optionally update password if provided
        if (!empty($data['password'])) {
            $set[] = '"password" = :password';
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql = 'UPDATE public."User_table" SET ' . implode(', ', $set) . ' WHERE user_id = :user_id';

        try {
            $stmt = $pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log('[userDatabase::updateById] PDOException: ' . $e->getMessage());
            return false;
        }
    }

}
 ?>