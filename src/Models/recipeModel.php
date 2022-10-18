<?php

namespace App\Models;

class RecipeModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getLastRecipeId()
    {
        return $this->db->lastInsertId();
    }

    public function addNewRecipe(array $recipe): bool
    {
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
        $query->bindParam(':name', $recipe['name']);
        $query->bindParam(':duration', $recipe['duration']);
        $query->bindParam(':cookTime', $recipe['cookTime']);
        $query->bindParam(':prepTime', $recipe['prepTime']);
        $query->bindParam(':instructions', $recipe['instructions']);
        return $query->execute();
    }

    public function linkRecipeToUser(int $userId, int $recipeId): bool
    {
        $query = $this->db->prepare("
        INSERT INTO `users_recipes` (
            `userId`,
            `recipeId`)
        VALUES (
            :userId,
            :recipeId");
        $query->bindParam(':userId', $userId);
        $query->bindParam(':recipeId', $recipeId);
        return $query->execute;
    }

    public function getUserRecipes(string $email): array
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
