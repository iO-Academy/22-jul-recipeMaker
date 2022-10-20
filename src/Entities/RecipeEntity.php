<?php

namespace App\Entities;

class RecipeEntity
{
    private $name;
    private $duration;
    private $cookTime;
    private $prepTime;
    private $instructions;
    private $email;
    private $userId;
    private $recipeId;
    private $ingredients = [];

   /**
    * Get name
    *
    * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }

   /**
    * Gets duration
    *
    */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Gets cook time
     */
    public function getCookTime()
    {
        return $this->cookTime;
    }

    /**
     * Get the value of prepTime
     */
    public function getPrepTime()
    {
        return $this->prepTime;
    }

    /**
     * Gets instructions
     *
     * @return string
     */
    public function getInstructions(): string
    {
        return $this->instructions;
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets id of current user
     *
     * @return integer
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Get the value of recipeId
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * Get the value of ingredients
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * adds an ingredient
     *
     * @param IngredientEntity $ingredient
     * @return void
     */
    public function addIngredient(IngredientEntity $ingredient): void
    {
        $this->ingredients[] = $ingredient;
    }
}
