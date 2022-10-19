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

    /**
     * Fetches last inserted recipe id
     *
     * @return string
     */
    public function getLastRecipeId(): string
    {
        return $this->db->lastInsertId();
    }

    /**
     * Inserts new recipe into DB
     *
     * @param [string] $name
     * @param [int] $duration
     * @param [int || null] $cookTime
     * @param [int || null] $prepTime
     * @param [string] $instructions
     * @return boolean
     */
    public function addNewRecipe(
        $name,
        $duration,
        $instructions,
        $cookTime = null,
        $prepTime = null
    ): bool {
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
            :instructions);");
        $query->bindParam(':name', $name);
        $query->bindParam(':duration', $duration);
        $query->bindParam(':cookTime', $cookTime);
        $query->bindParam(':prepTime', $prepTime);
        $query->bindParam(':instructions', $instructions);
        return $query->execute();
    }

    /**
     * Insert userid and recipeid to link table
     *
     * @param integer $userId
     * @param integer $recipeId
     * @return boolean
     */
    public function linkRecipeToUser(int $userId, int $recipeId): bool
    {
        $query = $this->db->prepare("
        INSERT INTO `users_recipes` (
            `userId`,
            `recipeId`)
        VALUES (
            :userId,
            :recipeId);");
        $query->bindParam(':userId', $userId);
        $query->bindParam(':recipeId', $recipeId);
        return $query->execute();
    }

    public function getUserRecipes(string $email): array
    {
        $query = $this->db->prepare("
        SELECT `name`, `duration`, `cookTime`, `prepTime`, `instructions`, `email`, `userId`
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
