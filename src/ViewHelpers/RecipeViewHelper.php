<?php

namespace App\ViewHelpers;

class RecipeViewhelper
{
    public static function displayUserRecipes($userRecipes)
    {
        $result = '';
        foreach ($userRecipes as $userRecipe) {
            $result .= '<p>' . $userRecipe->getName() . '<p>';
        }
        return $result;
    }
}
