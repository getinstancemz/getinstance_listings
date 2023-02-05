<?php
/* listing 009.16 */

namespace getinstance\utils\storyai\control;
use getinstance\utils\storyai\ai\Comms;;
use getinstance\utils\storyai\storymodel\Story;

class Runner
{
    private object $conf;

    public function __construct() {
        $conffile = __DIR__ . "/../../conf/storywrangle.json";
        $this->conf = json_decode(file_get_contents($conffile));
        $this->datadir = $conf->datadir ?? __DIR__ . "/../../data";
        if (! is_dir($this->datadir)) {
            throw new \Exception("could not find data directory");
        }
        $this->comms = new Comms($this->conf->secretKey);
    }

    public function start(string $story, string $genre, string $premise) {
        $storydir = $this->datadir . "/$story";
        mkdir($storydir, 0755, true);
        $story = new Story($genre, $premise);
        $resp = $this->comms->sendQuery($story->constructQuery()); 
        return $resp;
    }
}
