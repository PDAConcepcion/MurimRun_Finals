<?php 
require_once UTILS_PATH . '/envSetter.util.php';

class DBConnection
{
    /**
     * Get a PDO connection to the PostgreSQL database.
     * This method uses the global $databases array to retrieve
     *
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        global $databases;
        $host = $databases['pgHost'];
        $port = $databases['pgPort'];
        $username = $databases['pgUser'];
        $password = $databases['pgPassword'];
        $dbname = $databases['pgDB'];
        $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";

        return new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
}
 ?>