<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;

use Psr\Http\Message\ServerRequestInterface as SlimRequest;
use Psr\Http\Message\ResponseInterface as SlimResponse;

use Symfony\Component\HttpFoundation\Request as SymRequest;
use Symfony\Component\HttpFoundation\Response as SymResponse;

use gi\lazy\convertreqres\Convert1;
use gi\lazy\convertreqres\Convert2;
use gi\lazy\convertreqres\Convert3;
use gi\lazy\convertreqres\Convert4;
use gi\lazy\convertreqres\Utility;

final class Article007Test extends TestCase
{

    public function setUp(): void
    {
    }

    public function testCreateRequest(): void
    {
        $utility = new Utility();
        $req = $utility->makeSlimRequest("GET", "https://hats.com/");
        self::assertInstanceOf(SlimRequest::class, $req);

        $res = $utility->makeSlimResponse();
        self::assertInstanceOf(SlimResponse::class, $res);

        $sreq = $utility->makeSymRequest();
        self::assertInstanceOf(SymRequest::class, $sreq);

        $sres = $utility->makeSymResponse();
        self::assertInstanceOf(SymResponse::class, $sres);

        $converter1 = new Convert1();
        $convslimrequest = $converter1->symfonyToPsr7Request($sreq);
        self::assertInstanceOf(SlimRequest::class, $convslimrequest);

        $converter2 = new Convert2();
        $convslimresponse = $converter2->symfonyToPsr7Response($sres);
        self::assertInstanceOf(SlimResponse::class, $convslimresponse);
        $converter3 = new Convert3();
        $convsymrequest = $converter3->psr7ToSymfonyRequest($req);
        self::assertInstanceOf(SymRequest::class, $convsymrequest);

        $converter4 = new Convert4();
        $convsymresponse = $converter4->psr7ToSymfonyResponse($res);
        self::assertInstanceOf(SymResponse::class, $convsymresponse);
    }
}
