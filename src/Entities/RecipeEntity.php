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
    * @return integer
    */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Gets cook time 
     *
     * @return integer
     */
    public function getCookTime(): int
    {
        return $this->cookTime;
    }

    /**
     * Get the value of prepTime
     */
    public function getPrepTime(): int
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
