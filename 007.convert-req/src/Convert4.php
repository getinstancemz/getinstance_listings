<?php
namespace gi\lazy\convertreqres;

/* listing 007.07 */
use Psr\Http\Message\ResponseInterface as SlimResponse;
use Symfony\Component\HttpFoundation\Response as SymResponse;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

class Convert4 {

    public function psr7toSymfonyResponse(SlimResponse $resp): SymResponse
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyResponse = $httpFoundationFactory->createResponse($resp);
        return $symfonyResponse;
    }
}
