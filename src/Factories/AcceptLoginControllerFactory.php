<?php

namespace App\Factories;

use App\Controllers\AcceptLoginController;
use Psr\Container\ContainerInterface;

class AcceptLoginControllerFactory
{
    public function __invoke(ContainerInterface $container): AcceptLoginController
    {
        $userModel = $container->get('UserModel');
        return new AcceptLoginController($userModel);
    }
}
