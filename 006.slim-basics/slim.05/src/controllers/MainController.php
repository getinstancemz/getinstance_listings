<?php

namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class MainController extends Controller 
{
    function renderForm(Request $request, Response $response, array $args)
    {
        $args['salutation'] = $this->getConf()->get("salutation");
        return $this->render($response, "main.php", $args);
    }

/* listing 006.16 */
    function processForm(Request $request, Response $response, array $args)
    {
        $params = (array)$request->getParsedBody();
        $args['msg'] = $params['msg'];
        return $this->render($response, "process.php", $args);
    }
/* /listing 006.16 */
}

