<?php

/* listing 006.06 */
namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class MainController extends Controller 
{
    function renderForm(Request $request, Response $response, array $args)
    {
        $response->getBody()->write("hats");
        return $response;
    }

}

