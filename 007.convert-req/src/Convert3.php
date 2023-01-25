<?php
namespace gi\lazy\convertreqres;

/* listing 007.06 */
use Psr\Http\Message\ServerRequestInterface as SlimRequest;
use Symfony\Component\HttpFoundation\Request as SymRequest;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

class Convert3 {

    public function psr7toSymfonyRequest(SlimRequest $req): SymRequest
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyRequest = $httpFoundationFactory->createRequest($req);
        return $symfonyRequest;
    }
}
