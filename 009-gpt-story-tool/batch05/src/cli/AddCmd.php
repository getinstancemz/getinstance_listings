<?php

namespace getinstance\utils\storyai\cli;

class AddCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 2) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];
        $text = $args[1];

        $runner = $this->getRunner();
        $story = $runner->add($storyname, $text);
        $this->statusMsg($story);
        return true;
    }
    
}

