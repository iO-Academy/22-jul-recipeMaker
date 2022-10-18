<?php

namespace App\ViewHelpers;

class RecipeViewhelper
{
    public static function displayUserRecipes($userRecipes)
    {
        $result = '';
        foreach ($userRecipes as $userRecipe) {
            $result .= '<div class="col-12 col-lg-3 recipe m-3 p-0">';
            $result .= '<div class="d-flex align-items-center m-2 justify-content-between">';
            $result .= '<h2 class="my-auto recipe-name">' . $userRecipe->getName() . '</h2>';
            $result .= '<div class="d-flex"><h3 class="my-auto recipe-duration mx-1">';
            $result .= $userRecipe->getDuration() . ' mins</h3>';
            $result .= '<button class="btn-success recipe-button">+</button></div></div>';
            $result .= '<div class="recipe-content">';
            $result .= '<div class="d-flex justify-content-between">';
            $result .= '<p class="m-1">Cooking time: ' . $userRecipe->getCookTime() . ' mins</p>';
            $result .= '<p class="m-1">Preparation time: ' . $userRecipe->getPrepTime() . ' mins</p></div>';
            $result .= '<p class="font-weight-bold m-1">Instructions: </p>';
            $result .= '<p class="m-0 p-1">' . $userRecipe->getInstructions() . '</p>';
            $result .= '</div></div>';
        }
        return $result;
    }
}
