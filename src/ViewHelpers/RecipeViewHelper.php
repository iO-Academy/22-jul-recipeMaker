<?php

namespace App\ViewHelpers;

class RecipeViewhelper
{
    public static function displayUserRecipes($userRecipes)
    {
        $result = '';
        foreach ($userRecipes as $userRecipe) {
            $result .= '<div class="col recipe m-3 p-0">';
            $result .= '<div class="d-flex align-items-center m-2 justify-content-between">';
            $result .= '<h2>' . $userRecipe->getName() . '</h2>';
            $result .= '<h3>' . $userRecipe->getDuration() . ' minutes</h3></div>';
            $result .= '<div class="recipe-content">';
            $result .= '<p class="m-0">' . $userRecipe->getInstructions() . '</p>';
            $result .= '</div></div>';
        }
        return $result;
    }
}
