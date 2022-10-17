<?php

namespace App\Factories;

use App\Controllers\AddRecipeController;
use Psr\Container\ContainerInterface;

class AddRecipeControllerFactory
{
    public function __invoke(ContainerInterface $container): AddRecipeController
    {
        $addRecipe = $container->get('RecipeModel');
        return new AddRecipeController($addRecipe);
    }
}