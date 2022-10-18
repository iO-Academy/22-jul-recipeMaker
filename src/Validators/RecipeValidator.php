<?php

namespace App\Validators;

use App\CustomExceptions\InvalidRecipeException;
use Exception;

class RecipeValidator
{
    public static function validateRecipeForm(array $recipe): bool
    {
        try {
            self::validateRecipe($recipe['name'], 100);
            self::validateRecipe($recipe['duration'], 10);
            if ($recipe['cookTime'] !== null) {
                self::validateRecipe($recipe['cookTime'], 10);
            }
            if ($recipe['prepTime'] !== null) {
                self::validateRecipe($recipe['prepTime'], 10);
            }
            self::validateRecipe($recipe['instructions'], 10000);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private static function validateRecipe(string $recipeField, int $length)
    {
        if (empty($name) && strlen($recipeField) > $length) {
            throw new InvalidRecipeException($recipeField . ' is invalid');
        }
    }
}
