<?php

namespace App\Factories;

use App\Controllers\HomepageController;
use Psr\Container\ContainerInterface;

class HomepageControllerFactory
{
    public function __invoke(ContainerInterface $container): HomepageController
    {
        $renderer = $container->get('renderer');
        $recipeModel = $container->get('RecipeModel');
        $ingredientModel = $container->get('IngredientModel');
        return new HomepageController($renderer, $recipeModel, $ingredientModel);
    }
}
