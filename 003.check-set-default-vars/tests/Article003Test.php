<?php

declare(strict_types=1);

namespace gi\lazy\checkvar\tests;
use gi\lazy\checkvar\Examples;

use PHPUnit\Framework\TestCase;

final class Article003Test extends TestCase
{

    public function setUp(): void
    {
    }

    public function testAll(): void
    {
        $eg = new Examples();

        // check without test function
        $out = $this->obcheck(function() use ($eg) {
            $eg->naiveCheck();
        });
        $this->assertEquals($out, "doing something with 123");

        // check with empty 
        $out = $this->obcheck(function() use ($eg) {
            $eg->emptyCheck();
        });
        $this->assertEquals($out, "doing something with 321");

        // check with isset 
        $this->assertFalse($eg->issetCheckNoSet());
        $out = $this->obcheck(function() use ($eg) {
            $eg->issetCheckValSet();
        });
        $this->assertEquals($out, "doing something with hmm\n");

        // set default direct
        $fruit = $eg->directSetDefault();
        $this->assertEquals($fruit["fruit0"], "basic plums");

        $infruit['fruit0'] = "fancy plums";
        $fruit2 = $eg->directSetDefault($infruit);
        $this->assertEquals($fruit2["fruit0"], "fancy plums");

        // set default ternary 
        $fruit = $eg->ternarySetDefault();
        $this->assertEquals($fruit["fruit1"], "basic apples");

        $infruit['fruit1'] = "fancy apples";
        $fruit2 = $eg->ternarySetDefault($infruit);
        $this->assertEquals($fruit2["fruit1"], "fancy apples");

        // set default null coalescing
        $fruit = $eg->nullcoSetDefault();
        $this->assertEquals($fruit["fruit2"], "basic oranges");

        $infruit['fruit2'] = "fancy oranges";
        $fruit2 = $eg->nullcoSetDefault($infruit);
        $this->assertEquals($fruit2["fruit2"], "fancy oranges");

        // set default null coalescing assignment
        $fruit = $eg->nullcoassSetDefault();
        $this->assertEquals($fruit["fruit3"], "basic grapes");

        $infruit['fruit3'] = "fancy grapes";
        $fruit2 = $eg->nullcoassSetDefault($infruit);
        $this->assertEquals($fruit2["fruit3"], "fancy grapes");


    }

    private function obcheck(callable $callable)
    {
        ob_start();
        $callable();
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }
}
