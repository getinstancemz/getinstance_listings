<?php

namespace getinstance\utils\storyai\control;
use getinstance\utils\storyai\ai\Comms;;
use getinstance\utils\storyai\storymodel\Story;
use getinstance\utils\storyai\storymodel\PlotPoint;
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

    public function turn(string $story) {
        $node = $this->startOrResume($story);
    }

    private function startOrResume(string $story) {
        if (! is_dir($storydir)) {
            $this->resume($storydir);
        } else {
            $this->start($storydir);
        }
    }

    public function start(string $story, string $genre, string $premise) {
        $storydir = $this->datadir . "/$story";
        mkdir($storydir, 0755, true);
        $saver = new Saver($this->datadir, $story);
        $ie = new PlotPointMapper($saver);

        $story = new Story($genre, $premise);
        $resp = $this->comms->sendQuery($story->constructQuery()); 
        $nodes = PlotPoint::textGenerate($resp);
        $topnode = $story->getPremise();
        foreach($nodes as $node) {
            $topnode->addChild($node);
        }

        $ie->save($topnode);
        return $nodes;
    }
}
