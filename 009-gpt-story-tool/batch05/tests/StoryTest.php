<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;
use getinstance\utils\storyai\storymodel\Story;
use getinstance\utils\storyai\storymodel\PlotPoint;
use getinstance\utils\storyai\persist\PlotPointMapper;
use getinstance\utils\storyai\persist\Saver;
use getinstance\utils\storyai\control\Runner;

final class StoryTest extends TestCase
{

    public function setUp(): void
    {
    }
    private function buildNodeTree(): PlotPoint
    {
        $root = new PlotPoint(null, "Sarah goes for a walk");
        $root->addChild($level1_1 = new PlotPoint(null, "attacked by a dog"));
        $root->addChild($level1_2 = new PlotPoint(null, "sees a strange door in a tree"));
        $root->addChild($level1_3 = new PlotPoint(null, "stumbles onto an attack in progress"));

        $level1_1->addChild($level2_1 = new PlotPoint(null, "runs and falls into a hole"));
        $level1_1->addChild($level2_2 = new PlotPoint(null, "kills the dog"));
        $level1_1->addChild($level2_3 = new PlotPoint(null, "is rescued by a hunter"));

        return $root;
    }

    public function testStoryModel(): void
    {
        $story = new Story("thriller", "once upon a time");
        $this->assertInstanceOf(Story::class, $story);

        $root = $story->getPremise();

        $woods = new PlotPoint(null, "go to the woods");
        $root->addChild($woods);
        $this->assertInstanceOf(PlotPoint::class, $woods);

        $town  = new PlotPoint(null, "head to town");
        $root->addChild($town);
        $this->assertInstanceOf(PlotPoint::class, $town);

        $home  = new PlotPoint(null, "stay at home");
        $this->assertInstanceOf(PlotPoint::class, $home);
        $root->addChild($home);

        $town->addChild(
            new PlotPoint(null, "go to the pub")
            )->addChild(
                new PlotPoint(null, "get in a fight")
                )->addChild(
                    ($last = new PlotPoint(null, "accidentally kill the vicar"))
                    );
         
        $points = $last->storySoFar();
        $this->assertEquals($points[0], "once upon a time");
        $this->assertEquals($points[1], "head to town");
        $this->assertEquals($points[2], "go to the pub");
        $this->assertEquals($points[3], "get in a fight");
        $this->assertEquals($points[4], "accidentally kill the vicar");

        $points = PlotPoint::textToPoints("1. hats foots\n2. knees trees\n3. legs monsters\n");
        $this->assertEquals(count($points), 3);

        $current = $story->setCurrentNode($last->id); 
        self::assertEquals("$current", "accidentally kill the vicar");
    }

    public function testSaveLoad(): void
    {
        $root = $this->buildNodeTree();
        $sl = new PlotPointMapper(new Saver("/tmp/", "mystory"));
        $json = $sl->export($root);
        $newroot = $sl->import($json);
        
        $this->assertEquals($root, $newroot);
        $story = new Story("science fiction", $newroot);
        $foundnode = $story->findNode("notthere");
        $this->assertNull($foundnode);

        $level1 = $newroot->getChildren();
        $level2 = $level1[0]->getChildren();

        $testid = $level2[1]->id;
        $foundnode2 = $story->findNode($testid);
        $this->assertEquals($foundnode2, $level2[1]);
    }

    public function testRunner(): void
    {
        $runner = new Runner();
        $plotpoints = $runner->start(
            "happyland",
            "thriller",
            "a girl named jane and a boy named Roy live in a cottage near a lake. One day a stranger knocks at the door"
            );

        foreach ($plotpoints as $plotpoint) {
            fputs(STDERR, ">> {$plotpoint}\n\n");
        }
    }
}
