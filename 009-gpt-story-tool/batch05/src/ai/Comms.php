<?php

namespace getinstance\utils\storyai\ai;

use Orhanerday\OpenAi\OpenAi;
use OpenAI\Client;

class Comms {
  private string $secretKey;

    public function __construct($secretKey) {
        $this->secretKey = $secretKey;
    }

	function sendQuery_fake($prompt) {
        $fake  = "1) ".uniqid()."\n";
        $fake .= "2) ".uniqid()."\n";
        $fake .= "3) ".uniqid()."\n";
        return $fake;
    }

	function sendQuery($prompt) {
		$open_ai = new OpenAi($this->secretKey);
		$completion = $open_ai->complete([
			'engine' => 'text-davinci-003',
			'prompt' => $prompt,
			'temperature' => 0.9,
			//'temperature' => 0.5,
			'max_tokens' => 400,
			'frequency_penalty' => 0,
			'presence_penalty' => 0.6,
		]);

		$ret = json_decode($completion, true);
        if (! isset($ret['choices'][0]['text'])) {
			throw new \Exception($completion);
		}
		return $ret['choices'][0]['text'];
	}

/*
Array
(
    [id] => cmpl-6gHLBNwnyak0R7yDTK1dTNZfCaGPm
    [object] => text_completion
    [created] => 1675534453
    [model] => text-davinci-003
    [choices] => Array
        (
            [0] => Array
                (
                    [text] => 

1. Fantasy
2. Horror
3. Romance
4. Sci-Fi
5. Adventure
                    [index] => 0
                    [logprobs] => 
                    [finish_reason] => stop
                )

        )

    [usage] => Array
        (
            [prompt_tokens] => 11
            [completion_tokens] => 23
            [total_tokens] => 34
        )

)
*/
}




