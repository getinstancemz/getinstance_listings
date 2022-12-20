<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\tests;

use DI\Definition\Exception\InvalidDefinition;
use gi\lazy\phpdi\batch01\BusinessResults;
use gi\lazy\phpdi\batch01\ListingSet;
use gi\lazy\phpdi\batch01\BatchRunner as BatchRunner1;

use gi\lazy\phpdi\batch02\BatchRunner as BatchRunner2;

use gi\lazy\phpdi\batch03\BatchRunner as BatchRunner3;

use gi\lazy\phpdi\batch04\BatchRunner as BatchRunner4;
use gi\lazy\phpdi\batch04\BusinessResults as BusinessResults4;

use PHPUnit\Framework\TestCase;


final class Article005Test extends TestCase
{

    public function setUp(): void
    {
    }

    public function testBatch01(): void
    {
       
        $output = "hello world\n";
        $this->assertEquals($output, "hello world\n");

        // batch 1
        $brunner1 = new BatchRunner1();
        $listings1 = $brunner1 ->run1();
        $this->assertInstanceOf(ListingSet::class, $listings1);
    }

    public function testBatch02(): void
    {
        // batch 2
        $brunner2 = new BatchRunner2();
        $listings2 = $brunner2 ->run1();
        $this->assertInstanceOf(ListingSet::class, $listings2);
    }

    public function testBatch03(): void
    {
        // batch 3
        $brunner3 = new BatchRunner3();
        list( $busres3, $listings3 ) = $brunner3 ->run1();
        $this->assertInstanceOf(ListingSet::class, $listings3);

        // get / autowiring
        list( $busres3_1, $listings3_1 ) = $brunner3 ->run2();
        $this->assertInstanceOf(ListingSet::class, $listings3_1);
        $this->assertEquals(2, $busres3_1::$instno);

        // check inst number doesn't change
        list( $busres3_1, $listings3_1 ) = $brunner3 ->run2();
        $this->assertEquals(2, $busres3_1::$instno);

        // has / autowiring
        $this->assertTrue($brunner3 ->run3());

        // make / autowiring
        list( $busres3_2, $listings3_2 ) = $brunner3 ->run4();
        $this->assertEquals(3, $busres3_2::$instno);
    }

    public function testBatch04(): void
    {
        $brunner4 = new BatchRunner4();

        try {
            $brunner4->run1();
            $this->fail("should not reach this");
        } catch (\Exception $e) {
            self::assertSame(InvalidDefinition::class, get_class($e));
        }

        $bres = $brunner4->run2();
        $listings = $bres->getListings();
        $this->assertInstanceOf(ListingSet::class, $listings);


        $bres = $brunner4->run3();
        $listings = $bres->getListings();
        $this->assertInstanceOf(ListingSet::class, $listings);

        list($val, $retval) = $this->obcheck(function() use ($brunner4) {
            return $brunner4->run4();
        });
        $this->assertEquals("hats!", $val);

        // create function
        list($dump, $retval) = $this->obcheck(function() use ($brunner4) {
            return $brunner4->run5();
        });
        $this->assertInstanceOf(BusinessResults4::class, $retval);

        // autowire function
        list($dump2, $retval2) = $this->obcheck(function() use ($brunner4) {
            return $brunner4->run6();
        });
        $this->assertInstanceOf(BusinessResults4::class, $retval2);

        // factory function
        list($dump3, $retval3) = $this->obcheck(function() use ($brunner4) {
            return $brunner4->run7();
        });
        $this->assertInstanceOf(BusinessResults4::class, $retval3);


    }

    private function obcheck(callable $callable)
    {
        ob_start();
        $retval = $callable();
        $out = ob_get_contents();
        ob_end_clean();
        return [$out, $retval];
    }
}
