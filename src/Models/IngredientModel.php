<?php

namespace App\Models;

class IngredientModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Adds new ingredient into db
     *
     * @param string $name
     * @return boolean
     */
    public function addNewIngredient(string $name): bool
    {
        $query = $this->db->prepare("INSERT INTO `ingredients` (`name`) VALUES (:name);");
        $query->bindParam(':name', $name);
        return $query->execute();
    }

    /**
     * Updates link table between recipes and ingredients
     *
     * @param integer $recipeId
     * @param integer $ingredientId
     * @return boolean
     */
    public function linkIngredientToRecipe(int $recipeId, int $ingredientId): bool
    {
        $query = $this->db->prepare("
        INSERT INTO `recipes_ingredients` (
            `recipeId`,
            `ingredientId`)
        VALUES (
            :recipeId,
            :ingreientId);");
        $query->bindParam(':recipeId', $recipeId);
        $query->bindParam(':ingreientId', $ingredientId);
        return $query->execute();
    }

    /**
     * Fetches last inserted ingredient id
     *
     * @return string
     */
    public function getLastIngredientId(): string
    {
        return $this->db->lastInsertId();
    }
}
