<?php

namespace getinstance\utils\aichat\ai;

/* listing 012.03 */
use Orhanerday\OpenAi\OpenAi;

class Comms
{
    private string $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function sendQuery(Messages $messages): string
    {
        $open_ai = new OpenAi($this->secretKey);
        $completion = $open_ai->chat([
            'messages' => $messages->toArray(5),
            'temperature' => 0.5,
            'max_tokens' => 1000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        $ret = json_decode($completion, true);
        if (isset($ret['error'])) {
            throw new \Exception($ret['error']['message']);
        }
        if (! isset($ret['choices'][0]['message']['content'])) {
            throw new \Exception("Unknown error: " . $completion);
        }
        $response = $ret['choices'][0]['message']['content'];
        $messages->addMessage("assistant", $response);
        return $response;
    }
}
