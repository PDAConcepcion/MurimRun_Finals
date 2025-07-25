<?php
declare(strict_types=1);

class SectCouriers
{
    /**
     * Get all sect couriers from the database.
     * @param PDO $pdo
     * @return array
     */
    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query('SELECT * FROM public."SectCouriers_table" ORDER BY name');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Set the status of a courier (true for available, false for unavailable).
     * @param PDO $pdo
     * @param string $courier_id
     * @param bool $status
     * @return bool
     */
    public static function setStatus(PDO $pdo, string $courier_id, bool $status): bool
    {
        $stmt = $pdo->prepare('UPDATE public."SectCouriers_table" SET status = :status WHERE courier_id = :courier_id');
        return $stmt->execute([
            ':status' => $status ? 'true' : 'false', // <-- ensure string 'true'/'false' for PostgreSQL boolean
            ':courier_id' => $courier_id
        ]);
    }

    /**
     * Add a new sect courier.
     * @param PDO $pdo
     * @param array $data
     * @return void
     */
    public static function add(PDO $pdo, array $data): void
    {
        $stmt = $pdo->prepare('
        INSERT INTO public."SectCouriers" (name, sectname, rank, speedrating, status) VALUES (:name, :sectname, :rank, :speedrating, :status)'
    );

        $stmt->execute([
            'name' => $data['name'],
            'sectname' => $data['sectname'],
            'rank' => $data['rank'],
            'speedrating' => $data['speedrating'],
            'status' => $data['status'],
        ]);
    }

    /**
     * Get a sect courier by name.
     * Returns null if not found.
     * @param PDO $pdo
     * @param string $name
     * @return array|null
     */
    public static function getByName(PDO $pdo, string $name): ?array
    {
        $stmt = $pdo->prepare('SELECT * FROM public."SectCouriers_table" WHERE name = :name LIMIT 1');
        $stmt->execute([':name' => $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    /**
     * Check if the courier exists in the database.
     * Returns true if exists, false otherwise.
     * @param PDO $pdo
     * @param array $data
     * @return bool
     */
    public static function courierValid(PDO $pdo, array $data): bool
    {
        $stmt = $pdo->prepare('
            SELECT 1 FROM public."SectCouriers_table"
            WHERE name = :name
                AND sectname = :sectname
            LIMIT 1
        ');

        $stmt->execute([
            ':name' => $data['name'],
            ':sectname' => $data['sectname']
        ]);
        return (bool)$stmt->fetchColumn();
    }

    /**
     * Update a sect courier by name, including the name field.
     * @param PDO $pdo
     * @param string $oldName
     * @param array $data
     * @return bool
     */
    public static function updateById(PDO $pdo, string $courier_id, array $data): bool
    {
        $stmt = $pdo->prepare('
            UPDATE public."SectCouriers_table"
            SET name = :name,
                sectname = :sectname,
                rank = :rank,
                speedrating = :speedrating,
                status = :status
            WHERE courier_id = :courier_id
        ');
        return $stmt->execute([
            ':name' => $data['name'],
            ':sectname' => $data['sectname'],
            ':rank' => $data['rank'],
            ':speedrating' => $data['speedrating'],
            ':status' => $data['status'],
            ':courier_id' => $courier_id,
        ]);
    }

    /**
     * Remove a sect courier by courier_id.
     * @param PDO $pdo
     * @param string $courier_id
     * @return bool
     */
    public static function removeById(PDO $pdo, string $courier_id): bool
    {
        $stmt = $pdo->prepare('DELETE FROM public."SectCouriers_table" WHERE courier_id = :courier_id');
        return $stmt->execute([':courier_id' => $courier_id]);
    }
}
?>