<?php
declare(strict_types=1);

class Deliveries
{
    /**
     * Summary of getAll
     * This method retrieves all deliveries from the database.
     * @param PDO $pdo
     * @return array
     */
    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query('SELECT * FROM public."Deliveries_table" ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all deliveries with courier and sect names joined.
     * @param PDO $pdo
     * @return array
     */
    public static function getAllWithCourierAndSect(PDO $pdo): array
    {
        $stmt = $pdo->query('
            SELECT d.*, c.name AS courier_name, c.sectname AS sect_name
            FROM public."Deliveries_table" d
            JOIN public."SectCouriers_table" c ON d.courier_id = c.courier_id
            ORDER BY d.created_at DESC
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllWithCourierAndSectByUserId(PDO $pdo, string $user_id): array
    {
        $stmt = $pdo->prepare('
            SELECT d.*, c.name AS courier_name, c.sectname AS sect_name
            FROM public."Deliveries_table" d
            JOIN public."SectCouriers_table" c ON d.courier_id = c.courier_id
            WHERE d.user_id = :user_id
            ORDER BY d.created_at DESC
        ');
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Summary of getAllByUserId
     * This method retrieves all deliveries for a specific user by their user ID.
     * @param PDO $pdo
     * @param string $user_id
     * @return array
     */
    public static function getAllByUserId(PDO $pdo, string $user_id): array
    {
        $stmt = $pdo->prepare('SELECT * FROM public."Deliveries_table" WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Summary of getById
     * This method retrieves a delivery by its ID.
     * @param PDO $pdo
     * @param string $delivery_id
     * @return array|null
     */
    public static function getById(PDO $pdo, string $delivery_id): ?array
    {
        $stmt = $pdo->prepare('SELECT * FROM public."Deliveries_table" WHERE delivery_id = :delivery_id LIMIT 1');
        $stmt->execute([':delivery_id' => $delivery_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Summary of add
     * This method adds a new delivery to the database.
     * @param PDO $pdo
     * @param array $data
     * @return bool
     */
    public static function add(PDO $pdo, array $data): bool
    {
        $stmt = $pdo->prepare('
            INSERT INTO public."Deliveries_table"
            (user_id, courier_id, origin, destination, package_description, status, delivery_time_estimate, weight_kg)
            VALUES (:user_id, :courier_id, :origin, :destination, :package_description, :status, :delivery_time_estimate, :weight_kg)
        ');
        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':courier_id' => $data['courier_id'],
            ':origin' => $data['origin'],
            ':destination' => $data['destination'],
            ':package_description' => $data['package_description'],
            ':status' => $data['status'],
            ':delivery_time_estimate' => $data['delivery_time_estimate'],
            ':weight_kg' => $data['weight_kg'],
        ]);
    }

    /**
     * Summary of updateById
     * This method updates an existing delivery by its ID.
     * @param PDO $pdo
     * @param string $delivery_id
     * @param array $data
     * @return bool
     */
    public static function updateById(PDO $pdo, string $delivery_id, array $data): bool
    {
        $stmt = $pdo->prepare('
            UPDATE public."Deliveries_table"
            SET user_id = :user_id,
                courier_id = :courier_id,
                origin = :origin,
                destination = :destination,
                package_description = :package_description,
                status = :status,
                delivery_time_estimate = :delivery_time_estimate,
                weight_kg = :weight_kg
            WHERE delivery_id = :delivery_id
        ');
        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':courier_id' => $data['courier_id'],
            ':origin' => $data['origin'],
            ':destination' => $data['destination'],
            ':package_description' => $data['package_description'],
            ':status' => $data['status'],
            ':delivery_time_estimate' => $data['delivery_time_estimate'],
            ':weight_kg' => $data['weight_kg'],
            ':delivery_id' => $delivery_id,
        ]);
    }

    /**
     * Summary of removeById
     * This method removes a delivery by its ID.
     * @param PDO $pdo
     * @param string $delivery_id
     * @return bool
     */
    public static function removeById(PDO $pdo, string $delivery_id): bool
    {
        $stmt = $pdo->prepare('DELETE FROM public."Deliveries_table" WHERE delivery_id = :delivery_id');
        return $stmt->execute([':delivery_id' => $delivery_id]);
    }
}