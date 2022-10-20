<?php

namespace App\Factories;

use App\Controllers\GetIngredientsController;
use Psr\Container\ContainerInterface;

class GetIngredientsControllerFactory
{
    public function __invoke(ContainerInterface $container): GetIngredientsController
    {
        $ingredientModel = $container->get('IngredientModel');
        return new GetIngredientsController($ingredientModel);
    }
}