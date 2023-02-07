<?php

namespace getinstance\utils\storyai\cli;

class TellCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 1) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];

        $runner = $this->getRunner();
        $story = $runner->resume($storyname);
        $items = $story->getCurrentNode()->getCurrentAndParents();
        print "\n";
        foreach ($items as $item) {
            print "{$item->id}   $item\n";
        }
        print "\n";
        $this->statusMsg($story);
        return true;
    }
    
}


