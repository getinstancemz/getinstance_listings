<?php

/* listing 006.11 */
namespace getinstance\myapp\controllers;

use getinstance\myapp\util\Conf;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

abstract class Controller
{
    public function __construct(private Conf $conf)
    {
    }

    protected function render(Response $response, string $template, array $args): Response
    {
        $renderer = new PhpRenderer(__DIR__ . '/../../views/');
        $renderer->render($response, $template, $args);
        return $response;
    }

    public function getConf(): Conf
    {
        return $this->conf;
    }
}
