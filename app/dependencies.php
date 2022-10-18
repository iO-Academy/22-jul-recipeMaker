<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $container = [];

    $container[LoggerInterface::class] = function (ContainerInterface $c) {
        $settings = $c->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    };

    $container['renderer'] = function (ContainerInterface $c) {
        $settings = $c->get('settings')['renderer'];
        $renderer = new PhpRenderer($settings['template_path']);
        return $renderer;
    };
    $container['db'] = function () {
        $db = new \PDO('mysql:host=127.0.0.1; dbname=fishFood', 'root', 'password');
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $db;
    };

    // controllers
    $container['AcceptLoginController'] = DI\factory('\App\Factories\AcceptLoginControllerFactory');
    $container['HomepageController'] = DI\factory('\App\Factories\HomepageControllerFactory');
    $container['LoginController'] = DI\factory('\App\Factories\LoginControllerFactory');
    $container['AddRecipeController'] = DI\factory(('\App\Factories\AddRecipeControllerFactory'));

    // models
    $container['UserModel'] = DI\factory('\App\Factories\UserModelFactory');
    $container['RecipeModel'] = DI\factory('\App\Factories\RecipeModelFactory');

    $containerBuilder->addDefinitions($container);
};
