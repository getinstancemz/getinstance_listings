<?php
namespace gi\lazy\convertreqres;

/* listing 007.04 */
use Symfony\Component\HttpFoundation\Request as SymRequest;
use Psr\Http\Message\ServerRequestInterface as SlimRequest;
use Slim\Psr7\Factory\ServerRequestFactory as Psr17Factory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;


class Convert1 {
    public function symfonyToPsr7Request(SymRequest $sreq): SlimRequest
    {
        $psr17Factory = new Psr17Factory();
        $streamfactory = new StreamFactory();
        $uploadedfilefactory = new UploadedFileFactory();
        $responsefactory = new ResponseFactory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $streamfactory, $uploadedfilefactory, $responsefactory);
        $psrRequest = $psrHttpFactory->createRequest($sreq);
        return $psrRequest;
    }
}
