<?php

namespace App\Factories;

use App\Controllers\LoginController;
use Psr\Container\ContainerInterface;

class LoginControllerFactory
{
    public function __invoke(ContainerInterface $container): LoginController
    {
        $renderer = $container->get('renderer');
        return new LoginController($renderer);
    }
}
