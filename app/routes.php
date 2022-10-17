<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get('renderer');
        return $renderer->render($response, "index.php", $args);
    });

    $app->get('/login', 'LoginController');
    $app->post('/login', 'AcceptLoginController');

};
