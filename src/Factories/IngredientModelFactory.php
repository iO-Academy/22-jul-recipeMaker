<?php

namespace App\Factories;

use App\Models\IngredientModel;
use Psr\Container\ContainerInterface;

class IngredientModelFactory
{
    public function __invoke(ContainerInterface $container): IngredientModel
    {
        $db = $container->get('db');
        return new IngredientModel($db);
    }
}
