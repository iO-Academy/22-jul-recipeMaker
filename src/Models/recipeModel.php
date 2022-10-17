<?php

namespace App\Models;

class RecipeModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function addNewRecipe(
        $name,
        $duration,
        $cookTime,
        $prepTime,
        $instructions
    ) {
        $query = $this->db->prepare("
        INSERT INTO `recipes` (
            `name`, 
            `duration`, 
            `cookTime`, 
            `prepTime`, 
            `instructions`)
        VALUES (
            :name, 
            :duration, 
            :cookTime, 
            :prepTime, 
            :instructions");
        $query->bindParam(':name', $name);
        $query->bindParam(':duration', $duration);
        $query->bindParam(':cookTime', $cookTime);
        $query->bindParam(':prepTime', $prepTime);
        $query->bindParam(':instructions', $instructions);
        return $query->execute();
    }

    public function getUserRecipes($email)
    {
        $query = $this->db->prepare("
        SELECT `name`, `duration`, `cookTime`, `prepTime`, `instructions`, `recipeId`, `userId`, `email`
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
