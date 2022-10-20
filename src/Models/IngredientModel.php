<?php

namespace App\Models;

use App\Entities\IngredientEntity;

use function DI\string;

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

    /**
     * gets all ingredients from the database
     *
     * @param string $email
     * @return array
     */
    public function getUserIngredients(string $email): array
    {
        $query = $this->db->prepare("
        SELECT `ingredients`.`name`, `ingredientId`, `recipes_ingredients`.`recipeId`
        FROM `ingredients`
                LEFT JOIN `recipes_ingredients`
                    ON `ingredients`.`id` = `recipes_ingredients`.`ingredientId`
                LEFT JOIN `recipes`
                    ON `recipes_ingredients`.`recipeId` = `recipes`.`id`
                LEFT JOIN `users_recipes`
                    ON `recipes`.`id` = `users_recipes`.`recipeId`
                LEFT JOIN `users`
                    ON `users_recipes`.`userId` = `users`.`id`
                    WHERE `email` = :email;
        ");
        $query->bindParam(':email', $email);
        $query->setFetchMode(\PDO::FETCH_CLASS, IngredientEntity::class);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * gets all ingredients from the database
     *
     * @return array
     */
    public function getAllIngredients(): array
    {
        $query = $this->db->prepare("
        SELECT `name`, `id`
        FROM `ingredients`
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public static function filterDuplicateIngredients(array $ingredients, array $dbIngredients): array
    {
        $duplicateIngredients = [];
        foreach ($dbIngredients as $dbIngredient) {
            foreach ($ingredients as $ingredient) {
                if (is_string($ingredient) && $ingredient == $dbIngredient['name']) {
                    array_push($duplicateIngredients, $dbIngredient['id']);
                }
            }
        }
        return $duplicateIngredients;
    }
    public static function removeDuplicateIngredients(array $ingredients, array $dbIngredients): array
    {
        $filteredIngredients = [];
        if (is_string($ingredients[0])) {
            foreach ($ingredients as $ingredient) {
                if (is_string($ingredient)) {
                    foreach ($dbIngredients as $dbIngredient) {
                        if ($ingredient === $dbIngredient['name']) {
                            $filteredIngredients[] = $ingredient;
                        }
                    }
                } else {
                    $filteredIngredients = [];
                }
            }
            return array_diff($ingredients, $filteredIngredients);
        } else {
            return [];
        }
    }
}
