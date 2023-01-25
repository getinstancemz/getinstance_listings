<?php
namespace gi\lazy\convertreqres;

/* listing 007.05 */
use Symfony\Component\HttpFoundation\Response as SymResponse;
use Psr\Http\Message\ResponseInterface as SlimResponse;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory as Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class Convert2 {
    public function symfonyToPsr7Response(SymResponse $sresp): SlimResponse
    {
        $psr17Factory = new Psr17Factory();
        $streamfactory = new StreamFactory();
        $uploadedfilefactory = new UploadedFileFactory();
        $responsefactory = new ResponseFactory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $streamfactory, $uploadedfilefactory, $responsefactory);
        $psrResponse = $psrHttpFactory->createResponse($sresp);
        return $psrResponse;
    }
}
