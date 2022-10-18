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
     *
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
}
