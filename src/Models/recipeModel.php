<?php

namespace App\Models;

use App\Entities\RecipeEntity;

class RecipeModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getUserRecipes($email)
    {
        $query = $this->db->prepare("
        SELECT `name`, `duration`, `cookTime`, `prepTime`, `instructions`, `email`
                FROM `recipes`
                LEFT JOIN `users_recipes`
                    ON `recipes`.`id` = `users_recipes`.`recipeId`
                LEFT JOIN `users`
                    ON `users_recipes`.`userId` = `users`.`id`
                    WHERE `email` = :email;
        ");
        $query->bindParam(':email', $email);
        $query->setFetchMode(\PDO::FETCH_CLASS, RecipeEntity::class);
        $query->execute();
        return $query->fetchAll();
    }
}
