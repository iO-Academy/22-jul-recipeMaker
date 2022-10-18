<?php

namespace App\Sanitisers;

use App\CustomExceptions\InvalidRecipeException;
use Exception;

class RecipeSanitiser
{
    public static function sanitiseNewRecipe(array $recipe)
    {
        try {
            $result['name'] = filter_var($recipe['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $result['duration'] = filter_var($recipe['duration'], FILTER_SANITIZE_NUMBER_INT);
            if ($recipe['cookTime'] !== null) {
                $result['cookTime'] = filter_var($recipe['cookTime'], FILTER_SANITIZE_NUMBER_INT);
            }
            if ($recipe['prepTime'] !== null) {
                $result['prepTime'] = filter_var($recipe['prepTime'], FILTER_SANITIZE_NUMBER_INT);
            }
            $result['instructions'] = filter_var($recipe['instructions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            return $result;
        } catch (Exception $e) {
            return new InvalidRecipeException('Something went wrong, please try again');
        }
    }
}