<?php

namespace getinstance\myapp\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MainController extends Controller
{
    public function renderForm(Request $request, Response $response, array $args): Response
    {
        $args['salutation'] = $this->getConf()->get("salutation");
        return $this->render($response, "main.php", $args);
    }

/* listing 006.23 */
    public function processForm(Request $request, Response $response, array $args): Response
    {
        $params = (array)$request->getParsedBody();
        $args['msg'] = $params['msg'];
        return $this->render($response, "process.php", $args);
    }
/* /listing 006.23 */
}
