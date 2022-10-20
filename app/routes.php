<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', 'HomepageController');
    $app->post('/', 'AddRecipeController');
    $app->get('/ingredients', 'GetIngredientsController');
    $app->get('/login', 'LoginController');
    $app->post('/login', 'AcceptLoginController');
};
