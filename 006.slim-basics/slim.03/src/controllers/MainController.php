<?php

namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class MainController extends Controller 
{
/* listing 006.10 */
    function renderForm(Request $request, Response $response, array $args)
    {
        $salutation = $this->getConf()->get("salutation");
        $response->getBody()->write($salutation);
        return $response;
    }
/* /listing 006.10 */

}

