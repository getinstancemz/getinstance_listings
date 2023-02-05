<?php

namespace getinstance\utils\storyai\cli;

class StatusCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 1) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];

        $runner = $this->getRunner();
        $story = $runner->resume($storyname);
        $this->statusMsg($story, "Current id: ".$story->getCurrentNode()->id);
        return true;
    }
    
}

