<?php

namespace App\Models;

class UserModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function addUser(string $email)
    {
        $query = $this->db->prepare("
            INSERT INTO `users` (`email`)
                VALUES (:email);
        ");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchAll();
    }
}
