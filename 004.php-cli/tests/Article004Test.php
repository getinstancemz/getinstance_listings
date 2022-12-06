<?php

declare(strict_types=1);

namespace gi\lazy\checkvar\tests;
use gi\lazy\checkvar\Examples;

use PHPUnit\Framework\TestCase;

final class Article004Test extends TestCase
{

    public function setUp(): void
    {
    }

    public function testAll(): void
    {
        
        $output  = `php scripts/hellophp.php`;
        $this->assertEquals($output, "hello world\n");
 
        $output2  = `scripts/hellophp2.php`;
        $this->assertEquals($output2, "hello world\n");

        $sprintfusage = $this->obcheck(function() {
            print `scripts/dircount.php -h`;
        });
        $basicusage = $this->obcheck(function() {
            print `scripts/dircount_usage.php`;
        });

        // remove _usage
        $basicusage = preg_replace("/_usage/", "", $basicusage);
        $this->assertEquals($sprintfusage, $basicusage);

        // run flags
        $flags = $this->obcheck(function() {
            print `scripts/dircount.php -a -p ssss /usr/local`;
        });
        print $flags;
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
