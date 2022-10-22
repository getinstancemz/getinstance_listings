<?php

declare(strict_types=1);

namespace gi\lazy\conditionals\tests;

// shared
use gi\lazy\conditionals\common\Account;
use gi\lazy\conditionals\common\Offer;

// return early
use gi\lazy\conditionals\before\ShortCircuit;
use gi\lazy\conditionals\after\ShortCircuit as Sc2;

// extract method
use gi\lazy\conditionals\before\DuplicateClauses;
use gi\lazy\conditionals\after\DuplicateClauses1;

// factor duplicates
use gi\lazy\conditionals\after\DuplicateClauses2;

// replace with polymorphism
use gi\lazy\conditionals\before\UserBilling;
use gi\lazy\conditionals\after\EuUserBilling;
use gi\lazy\conditionals\after\WorldUserBilling;

// replace with strategy
use gi\lazy\conditionals\before\Report;

use PHPUnit\Framework\TestCase;

final class Article002Test extends TestCase
{

    public function setUp(): void
    {
    }

    public function testShortCircuit(): void
    {
        // before
        $sc = new ShortCircuit(); 
        $this->assertEquals("success", $sc->renderRoom("living"));
        $this->assertEquals("error", $sc->renderRoom("hatstand"));

        // after
        $sc2 = new Sc2(); 
        $this->assertEquals("success", $sc2->renderRoom("living"));
        $this->assertEquals("error", $sc2->renderRoom("hatstand"));
    }

    public function testExtractAndFactor(): void
    {
        $dup1 = new DuplicateClauses();
        $account = new Account();

        // original 

        $account->setIsEu(false);
        $expirestr1 = $dup1->accountInfo($account);
        $this->assertEquals($expirestr1, "2025-06-24");

        $account->setIsEu(true);
        $expirestr2 = $dup1->accountInfo($account);
        $this->assertEquals($expirestr2, "2024-06-24");

        // extract method
 
        $dup2 = new DuplicateClauses1();
        $account->setIsEu(false);
        $expirestr3 = $dup2->accountInfo($account);
        $this->assertEquals($expirestr3, "2025-06-24");

        $account->setIsEu(true);
        $expirestr4 = $dup2->accountInfo($account);
        $this->assertEquals($expirestr4, "2024-06-24");

        // factor duplications
 
        $dup3 = new DuplicateClauses2();
        $account->setIsEu(false);
        $expirestr5 = $dup3->accountInfo($account);
        $this->assertEquals($expirestr5, "2025-06-24");

        $account->setIsEu(true);
        $expirestr6 = $dup3->accountInfo($account);
        $this->assertEquals($expirestr6, "2024-06-24");


    }

    public function testUserBilling(): void
    {
        $account = new Account();
        $offer = new Offer();
        $ub1= new UserBilling($account);

        $account->setIsEu(false);
        $expstr1 = $ub1->accountInfo();
        $charge1 = $ub1->applyOffer($offer);
        $this->assertEquals($expstr1, "2025-06-24");
        $this->assertEquals($charge1, 4);

        $account->setIsEu(true);
        $expstr2 = $ub1->accountInfo();
        $charge2 = $ub1->applyOffer($offer);
        $this->assertEquals($expstr2, "2024-06-24");
        $this->assertEquals($charge2, 3);

        $account->setIsEu(true);
        $ub2= new EuUserBilling($account);
        $expstr3 = $ub2->accountInfo();
        $charge3 = $ub2->applyOffer($offer);
        $this->assertEquals($expstr3, "2024-06-24");
        $this->assertEquals($charge3, 3);

        $account->setIsEu(false);
        $ub3= new WorldUserBilling($account);
        $expstr4 = $ub3->accountInfo();
        $charge4 = $ub3->applyOffer($offer);
        $this->assertEquals($expstr4, "2025-06-24");
        $this->assertEquals($charge4, 4);

    }

    public function testReport(): void
    {
        $report2 = new Report();

        ob_start();
        $report2->output();
        $output = ob_get_contents();
        ob_end_clean();

        self::assertEquals("pants", $output);
    }
}
