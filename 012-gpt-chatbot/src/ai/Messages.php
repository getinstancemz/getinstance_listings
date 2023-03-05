<?php

namespace getinstance\utils\aichat\ai;

/* listing 012.02 */
class Messages
{
    private string $description;
    private array $messages = [];

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function addMessage(string $role, string $message)
    {
        $this->messages[] = ["role" => $role, "content" => $message];
    }

    public function toArray($max = 0)
    {
        $desc = [ "role" => "system", "content" => "You are a {$this->description} assistant" ];
        $messages = $this->messages;
        if ($max > 0) {
            $messages = array_slice($this->messages, ($max * -1));
        }
        return array_merge([$desc], $messages);
    }
}
