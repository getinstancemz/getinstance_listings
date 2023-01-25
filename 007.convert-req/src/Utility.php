<?php
namespace gi\lazy\convertreqres;

use Symfony\Component\HttpFoundation\Request as SymRequest;
use Symfony\Component\HttpFoundation\Response as SymResponse;
use Psr\Http\Message\ResponseInterface as SlimResponse;
use Psr\Http\Message\ServerRequestInterface as SlimRequest;

use Slim\Psr7\Factory\ServerRequestFactory as Psr17Factory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Slim\Psr7\Factory\RequestFactory;

use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

class Utility {

    public function makeSlimResponse(): SlimResponse
    {   
        $responsefactory = new ResponseFactory();
        $response = $responsefactory->createResponse();
        return $response;
    }   

    public function makeSlimRequest(string $method, string $url): SlimRequest
    {   
        $requestfactory = new RequestFactory();
        $request = $requestfactory->createRequest($method, $url);
        return $request;
    }   

    public function makeSymRequest(): SymRequest
    {   
        //return SymRequest::createFromGlobals();
        $symreq = new SymRequest([], [], [], [], [], ['HTTP_HOST' => 'dunglas.fr'], 'Content');
        return $symreq;
    }

    public function makeSymResponse(): SymResponse
    {   
        $response = new SymResponse(
            "Hello world",
            SymResponse::HTTP_OK,
            ['content-type' => 'text/html']
            );
		return $response;
    }
}
