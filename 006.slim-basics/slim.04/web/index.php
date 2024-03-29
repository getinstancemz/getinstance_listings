<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use getinstance\myapp\util\Conf;
use getinstance\myapp\controllers\MainController;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions([
    "settings" => [
        "salutation" => "welcome!"
    ],
    Conf::class => \DI\autowire()->constructor(\DI\get("settings")),
]);

$container = $containerBuilder->build();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', MainController::class . ":renderForm");

$app->run();
