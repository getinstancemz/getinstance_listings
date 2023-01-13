<?php

/* listing 006.11 */
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use getinstance\myapp\controllers\MainController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', MainController::class . ":renderForm");

$app->run();
