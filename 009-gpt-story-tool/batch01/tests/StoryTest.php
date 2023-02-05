<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;
use getinstance\utils\storyai\storymodel\Story;
use getinstance\utils\storyai\storymodel\PlotPoint;
use getinstance\utils\storyai\persist\ImportExport;

final class StoryTest extends TestCase
{

    public function setUp(): void
    {
    }
    private function buildNodeTree(): PlotPoint
    {
        $root = new PlotPoint("Sarah goes for a walk");
        $root->addChild($level1_1 = new PlotPoint("attacked by a dog"));
        $root->addChild($level1_2 = new PlotPoint("sees a strange door in a tree"));
        $root->addChild($level1_3 = new PlotPoint("stumbles onto an attack in progress"));

        $level1_1->addChild($level2_1 = new PlotPoint("runs and falls into a hole"));
        $level1_1->addChild($level2_2 = new PlotPoint("kills the dog"));
        $level1_1->addChild($level2_3 = new PlotPoint("is rescued by a hunter"));

        return $root;
    }
    public function testStoryModel(): void
    {
        $story = new Story("once upon a time");
        $this->assertInstanceOf(Story::class, $story);

        $woods = new PlotPoint("go to the woods");
        $this->assertInstanceOf(PlotPoint::class, $woods);
        $town  = new PlotPoint("head to town");
        $this->assertInstanceOf(PlotPoint::class, $town);
        $home  = new PlotPoint("stay at home");
        $this->assertInstanceOf(PlotPoint::class, $home);

        /* listing 009.07 */
        $town->addChild(
            new PlotPoint("go to the pub")
            )->addChild(
                new PlotPoint("get in a fight")
                )->addChild(
                    ($last = new PlotPoint("accidentally kill the vicar"))
                    );
        /* /listing 009.07 */
         
        //fputs(STDERR, implode("\n", $last->storySoFar()));		
        $points = $last->storySoFar();
        $this->assertEquals($points[0], "head to town");
        $this->assertEquals($points[1], "go to the pub");
        $this->assertEquals($points[2], "get in a fight");
        $this->assertEquals($points[3], "accidentally kill the vicar");
    }

    public function testSaveLoad(): void
    {
        $root = $this->buildNodeTree();
        $sl = new ImportExport();
        $json = $sl->export($root);
        $newroot = $sl->import($json);
        // confirm that deviating will cause failure of equivalence test
        // $level1 = $newroot->getChildren();
        // $level2 = $level1[0]->getChildren();
        // $level2[0]->setPoint("hats");
        $this->assertEquals($root, $newroot);
    }
}
