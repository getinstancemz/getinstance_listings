<?php

namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MainController extends Controller
{
/* listing 006.19 */
    public function renderForm(Request $request, Response $response, array $args): Response
    {
        $args['salutation'] = $this->getConf()->get("salutation");
        return $this->render($response, "main.php", $args);
    }
/* /listing 006.19 */
}
