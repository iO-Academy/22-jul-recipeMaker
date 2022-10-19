<?php

namespace App\Sanitisers;

use App\CustomExceptions\InvalidRecipeException;
use Exception;

class RecipeSanitiser
{
    /**
     * Sanitises add new recipe form
     *
     * @param array $recipe
     * @return array or exception
     */
    public static function sanitiseNewRecipe(array $recipe)
    {
        try {
            $result['name'] = filter_var($recipe['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $result['duration'] = filter_var($recipe['duration'], FILTER_SANITIZE_NUMBER_INT);
            if (isset($recipe['cookTime'])) {
                $result['cookTime'] = filter_var($recipe['cookTime'], FILTER_SANITIZE_NUMBER_INT);
            }
            if (isset($recipe['prepTime'])) {
                $result['prepTime'] = filter_var($recipe['prepTime'], FILTER_SANITIZE_NUMBER_INT);
            }
            $result['instructions'] = filter_var($recipe['instructions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (isset($recipe['ingredients'])) {
                $result['ingredients'] = [];
                foreach ($recipe['ingredients'] as $ingredients) {
                    $result['ingredients'][] .= filter_var($ingredients, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
            }
            return $result;
        } catch (Exception $e) {
            return new InvalidRecipeException('Something went wrong, please try again');
        }
    }
}
