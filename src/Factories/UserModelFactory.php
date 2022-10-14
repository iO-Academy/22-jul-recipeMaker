<?php

namespace App\Factories;

use App\Models\UserModel;
use Psr\Container\ContainerInterface;

class UserModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get('db');
        return new UserModel($db);
    }
}
