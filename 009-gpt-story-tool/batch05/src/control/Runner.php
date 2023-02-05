<?php

namespace getinstance\utils\storyai\control;
use getinstance\utils\storyai\ai\Comms;;
use getinstance\utils\storyai\storymodel\Story;
use getinstance\utils\storyai\storymodel\PlotPoint;
use getinstance\utils\storyai\persist\StoryMapper;
use getinstance\utils\storyai\persist\PlotPointMapper;
use getinstance\utils\storyai\persist\Saver;

class Runner
{
    private object $conf;

    public function __construct() {
        $conffile = __DIR__ . "/../../conf/storywrangle.json";
        $this->conf = json_decode(file_get_contents($conffile));
        $this->datadir = $conf->datadir ?? __DIR__ . "/../../data";
        $this->comms = new Comms($this->conf->secretKey);
    }

    public function getMapper(string $storyname): StoryMapper
    {
        $saver = new Saver($this->datadir, $storyname);
        $mapper = new StoryMapper(
            $saver, 
            new PlotPointMapper($saver)
            );
        return $mapper;
    }

    public function go(string  $storyname, string $nodeid): story
    {
        $mapper = $this->getMapper($storyname);
        $story = $this->resume($storyname);
        $story->setCurrentNode($nodeid);
        $mapper->save($story);
        return $story;
    }


    public function add(string  $storyname, string $text): story
    {
        $mapper = $this->getMapper($storyname);
        $story = $this->resume($storyname);
        $currentnode = $story->getCurrentNode();
        $newnode = new PlotPoint(null, $text);
        $currentnode->addChild($newnode);
        $mapper->save($story);
        return $story;
    }

    public function deleteNode(string  $storyname, string $nodeid): story
    {
        $mapper = $this->getMapper($storyname);
        $story = $this->resume($storyname);
        $story->deleteNode($nodeid);

/*
        $currentnode = $story->getCurrentNode();
        $newnode = new PlotPoint(null, $text);
        $currentnode->addChild($newnode);
*/
        $mapper->save($story);
        return $story;
    }

    public function askAi(string  $storyname): story
    {
        $mapper = $this->getMapper($storyname);
        $story = $this->resume($storyname);
        $resp = $this->comms->sendQuery($story->constructQuery()); 
        $nodes = PlotPoint::textToPoints($resp);
        $currentnode = $story->getCurrentNode();
        foreach($nodes as $node) {
            $currentnode->addChild($node);
        }

        $mapper->save($story);
        return $story;
    }

    public function resume(string $storyname): story 
    {
        $mapper = $this->getMapper($storyname);
        if (! $mapper->saveExists()) {
            throw new \Exception("no such story: $storyname");
        }
        return $mapper->load();
    }


    public function start(string $storyname, string $genre, string $premise): story 
    {
        $mapper = $this->getMapper($storyname);
        if ($mapper->saveExists()) {
            throw new \Exception("can't start an existing story: $storyname");
        }

        

        $story = new Story($genre, $premise);
        $mapper->save($story);
        return $story;
        /*
        $resp = $this->comms->sendQuery($story->constructQuery()); 
        $nodes = PlotPoint::textToPoints($resp);
        $topnode = $story->getPremise();
        foreach($nodes as $node) {
            $topnode->addChild($node);
        }

        $mapper->save($story);
        return $nodes;
        */
    }
}
