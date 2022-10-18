<?php

namespace App\Factories;

use App\Models\RecipeModel;
use Psr\Container\ContainerInterface;

class RecipeModelFactory
{
    public function __invoke(ContainerInterface $container): RecipeModel
    {
        $db = $container->get('db');
        return new RecipeModel($db);
    }
}
