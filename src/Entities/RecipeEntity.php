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

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get the value of cookTime
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
     * Get the value of instructions
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }
}
