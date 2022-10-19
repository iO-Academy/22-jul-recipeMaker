<?php

namespace App\Factories;

use App\Controllers\AddRecipeController;
use Psr\Container\ContainerInterface;

class AddRecipeControllerFactory
{
    public function __invoke(ContainerInterface $container): AddRecipeController
    {
        $recipeModel = $container->get('RecipeModel');
        $ingredientModel = $container->get('IngredientModel');
        return new AddRecipeController($recipeModel, $ingredientModel);
    }
}
