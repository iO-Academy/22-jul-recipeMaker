<?php

namespace App\ViewHelpers;

class RecipeViewhelper
{
    /**
     * Displays the user's recipes
     *
     * @param array $userRecipes
     * @return string
     */
    public static function displayUserRecipes(array $userRecipes): string
    {
        $result = '';
        foreach ($userRecipes as $userRecipe) {
            $result .= '<div class="col-12 col-lg-3 recipe m-3 p-0">';
            $result .= '<div class="d-flex align-items-center m-2 justify-content-between">';
            $result .= '<h2 class="my-auto recipe-name">' . $userRecipe->getName() . '</h2>';
            $result .= '<div class="d-flex"><h3 class="my-auto recipe-duration mx-1">';
            $result .= $userRecipe->getDuration() . ' mins</h3>';
            $result .= '<button class="recipe-button">+</button></div></div>';
            $result .= '<div class="recipe-content">';
            $result .= '<div class="d-flex justify-content-between">';
            $result .= $userRecipe->getCookTime() == null ?
                '' : '<p class="m-1">Cooking time: ' . $userRecipe->getCookTime() . ' mins</p>';
            $result .= $userRecipe->getPrepTime() == null ?
                '' : '<p class="m-1">Preparation time: ' . $userRecipe->getPrepTime() . ' mins</p>';
            $result .= '</div>';
            $result .= '<p class="font-weight-bold m-1">Instructions: </p>';
            $result .= '<p class="m-0 p-1">' . $userRecipe->getInstructions() . '</p>';
            $result .= '</div></div>';
        }
        return self::handleNoRecipes($result);
    }

    /**
     * If no recipes found, returns message saying no recipes found.
     *
     * @param string $output
     *
     * @return string
     */
    private static function handleNoRecipes(string $output): string
    {
        if (empty($output)) {
            $result = '<div class="col-12 col-lg-3 no-recipe m-3 p-3"><h5 class="text-center">No recipes found.<br>';
            $result .= 'Click the \'+\' in the top right to get started!</h5></div>';
            return $result;
        }
        return $output;
    }
}
