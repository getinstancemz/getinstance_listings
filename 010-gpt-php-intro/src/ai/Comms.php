<?php

/* listing 010.04 */
namespace getinstance\utils\aibasic\ai;

use Orhanerday\OpenAi\OpenAi;

class Comms
{
    private string $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function sendQuery(string $prompt): string
    {
        $open_ai = new OpenAi($this->secretKey);
        $completion = $open_ai->complete([
            'engine' => 'text-davinci-003',
            'prompt' => $prompt,
            'temperature' => 0.5,
            'max_tokens' => 1000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);
        $ret = json_decode($completion, true);
        if (isset($ret['error'])) {
            throw new \Exception($ret['error']['message']);
        }
        if (! isset($ret['choices'][0]['text'])) {
            throw new \Exception("Unknown error: " . $completion);
        }
        return $ret['choices'][0]['text'];
    }
}
