<?php

/* listing 010.05 */
namespace getinstance\utils\aibasic\control;

use getinstance\utils\aibasic\ai\Comms;

class Runner
{
    private object $conf;

    public function __construct()
    {
        $conffile = __DIR__ . "/../../conf/aibasic.json";
        $this->conf = json_decode(file_get_contents($conffile));
        $this->datadir = $conf->datadir ?? __DIR__ . "/../../data";
        $this->comms = new Comms($this->conf->secretKey);
    }

    public function askAi(string $query): string
    {
        $resp = $this->comms->sendQuery($query);
        return $resp;
    }
}
