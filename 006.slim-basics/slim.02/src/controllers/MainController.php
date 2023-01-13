<?php

/* listing 006.10 */
namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MainController extends Controller
{
    public function renderForm(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write("hats");
        return $response;
    }
}
