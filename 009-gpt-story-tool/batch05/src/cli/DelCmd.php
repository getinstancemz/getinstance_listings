<?php

namespace getinstance\utils\storyai\cli;

class DelCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 2) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];
        $delid = $args[1];
        
        $runner = $this->getRunner();
        $story = $runner->deleteNode($storyname, $delid);
        $this->statusMsg($story);
        return true;
    }
    
}


