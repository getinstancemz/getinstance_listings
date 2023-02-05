<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use getinstance\utils\storyai\storymodel\Story;
use getinstance\utils\storyai\storymodel\PlotPoint;
error_reporting(E_ALL);
ini_set('display_errors', '1');

class Batch01 {

    public function test01(): void
    {
        $town  = new PlotPoint("head to town");
        $town->addChild(
            new PlotPoint("go to the pub")
            )->addChild(
                new PlotPoint("get in a fight")
                )->addChild(
                    ($last = new PlotPoint("accidentally kill the vicar"))
                    );
        print "hello";
        print $last->storySoFar();		
    }
}

$x = new Batch01();
$x->test01();
