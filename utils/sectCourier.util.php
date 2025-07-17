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
    public static function updateByName(PDO $pdo, string $oldName, array $data): bool
    {
        $stmt = $pdo->prepare('
            UPDATE public."SectCouriers_table"
            SET name = :newName,
                sectname = :sectname,
                rank = :rank,
                speedrating = :speedrating,
                status = :status
            WHERE name = :oldName
        ');
        return $stmt->execute([
            ':newName' => $data['name'],
            ':sectname' => $data['sectname'],
            ':rank' => $data['rank'],
            ':speedrating' => $data['speedrating'],
            ':status' => $data['status'],
            ':oldName' => $oldName,
        ]);
    }

    /**
     * Remove a sect courier by name.
     * @param PDO $pdo
     * @param string $name
     * @return bool
     */
    public static function removeByName(PDO $pdo, string $name): bool
    {
        $stmt = $pdo->prepare('DELETE FROM public."SectCouriers_table" WHERE name = :name');
        return $stmt->execute([':name' => $name]);
    }
}
?>