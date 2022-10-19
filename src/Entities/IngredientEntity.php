<?php

namespace App\Entities;

class IngredientEntity
{
    private $name;
    private $ingredientId;

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
}
