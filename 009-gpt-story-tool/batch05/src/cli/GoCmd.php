<?php

namespace getinstance\utils\storyai\cli;

class GoCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 2) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];
        $targetid = $args[1];

        $runner = $this->getRunner();
        $story = $runner->go($storyname, $targetid);
        $this->statusMsg($story);
        return true;
    }
    
}

