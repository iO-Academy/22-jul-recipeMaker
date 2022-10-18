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
        return new HomepageController($renderer, $recipeModel);
    }
}
