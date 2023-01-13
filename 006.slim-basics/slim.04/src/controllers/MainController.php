<?php

namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class MainController extends Controller 
{
/* listing 006.12 */
    function renderForm(Request $request, Response $response, array $args)
    {
        $args['salutation'] = $this->getConf()->get("salutation");
        return $this->render($response, "main.php", $args);
    }
/* /listing 006.12 */

}

