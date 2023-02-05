<?php

require_once(__DIR__ . "/../vendor/autoload.php");


use getinstance\utils\storyai\ai\Comms;

$conffile = __DIR__ . "/../conf/storywrangle.json";
$conf = json_decode(file_get_contents($conffile));
$comms = new Comms($conf->secretKey);
$resp = $comms->sendQuery("This is a cyberpunk story about a girl who walks out into the forest one summer morning. Provide three alternative plot points each one describing single different event that follows immediately after the setup.");

// response
/*
1. She discovers a strange, glowing object in the middle of the forest and decides to take it with her. 
2. She encounters a group of cyborgs who are searching for something in the woods. 
3. She meets a mysterious stranger who tells her about a powerful secret hidden deep within the forest.
*/

print_r($resp);
