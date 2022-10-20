<?php

namespace App\Entities;

class IngredientEntity
{
    private $name;
    private $ingredientId;
    private $recipeId;

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of ingredientId
     */
    public function getIngredientId(): int
    {
        return $this->ingredientId;
    }

    /**
     * Get the value of recipeId
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * returns name when called as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
