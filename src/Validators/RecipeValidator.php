<?php

namespace App\Validators;

use App\CustomExceptions\InvalidRecipeException;
use Exception;

class RecipeValidator
{
    /**
     * Validates all fields from the add recipe form
     *
     * @param array $recipe
     * @return boolean
     */
    public static function validateRecipeForm(array $recipe): bool
    {
        try {
            self::validateRecipe($recipe['name'], 100);
            self::validateRecipe($recipe['duration'], 10);
            if (isset($recipe['cookTime'])) {
                self::validateRecipe($recipe['cookTime'], 10);
            }
            if (isset($recipe['prepTime'])) {
                self::validateRecipe($recipe['prepTime'], 10);
            }
            self::validateRecipe($recipe['instructions'], 10000);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Validates individual recipe form field
     *
     * @param string $recipeField
     * @param integer $length
     * @return InvalidRecipeException
     */
    private static function validateRecipe(string $recipeField, int $length)
    {
        if (empty($name) && strlen($recipeField) > $length) {
            throw new InvalidRecipeException($recipeField . ' is invalid');
        }
    }
}
