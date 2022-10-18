<?php

namespace App\Models;

class UserModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Adds user to database
     *
     * @param string $email
     * @return boolean
     */
    public function addUser(string $email): bool
    {
        $query = $this->db->prepare("
            INSERT INTO `users` (`email`)
                VALUES (:email);
        ");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query;
    }
    /**
     * Gets current user's id from the database
     *
     * @param [string] $email
     * @return integer
     */
    public function getCurrentUserId(string $email): int
    {
        $query = $this->db->prepare("
        SELECT `id`
        FROM `users`
        WHERE `email` = :email;
        ");
        $query->bindParam(':email', $email);
        $query->execute();
        $result = $query->fetch();
        return $result['id'];
    }

    public function getAllUsers(): array
    {
        $query = $this->db->prepare("
            SELECT `id`, `email`
                FROM `users`;
        ");
        $query->execute();
        return $query->fetchAll();
    }
}
