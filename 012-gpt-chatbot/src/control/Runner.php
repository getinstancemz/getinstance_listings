<?php

namespace getinstance\utils\aichat\control;

use getinstance\utils\aichat\ai\Comms;
use getinstance\utils\aichat\ai\Messages;

/* listing 012.04 */
class Runner
{
    private object $conf;

    public function __construct()
    {
        $conffile = __DIR__ . "/../../conf/chat.json";
        $this->conf = json_decode(file_get_contents($conffile));
/* /listing 012.04 */
        $this->datadir = $conf->datadir ?? __DIR__ . "/../../data";
/* listing 012.04 */
        $this->comms = new Comms($this->conf->openai->token);
    }

    public function start(string $assistant = "helpful, interested, and witty")
    {
        $messages = new Messages($assistant);
        return $messages;
    }

    public function query(Messages $messages, string $message)
    {
        $messages->addMessage("user", $message);
        return $this->comms->sendQuery($messages);
    }
/* /listing 012.04 */
    public function save(string $convo, Messages $messages)
    {
        $payload = json_encode($messages->toArray());
        $path = $this->datadir . "/" . $convo . ".json";
        file_put_contents($path, $payload);
    }
/* listing 012.04 */
}
