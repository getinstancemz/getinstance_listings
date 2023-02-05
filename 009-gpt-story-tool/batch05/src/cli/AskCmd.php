<?php

namespace getinstance\utils\storyai\cli;

class AskCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 1) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];

        $runner = $this->getRunner();
        $story = $runner->askAi($storyname);
        $this->statusMsg($story);
        return true;
    }
    
}


