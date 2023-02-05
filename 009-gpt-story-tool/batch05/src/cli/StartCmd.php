<?php

/* listing 009.28 */
namespace getinstance\utils\storyai\cli;

class StartCmd extends CliCmd
{
    public function run(array $args): bool
    {
        if (count($args) < 3) {
            throw new \Exception("not enough arguments");
        }

        $storyname = $args[0];
        $genre = $args[1];
        $prompt = $args[2];

        $runner = $this->getRunner();
        $story = $runner->start($storyname, $genre, $prompt);
        $this->statusMsg($story);
        return true;
    }
    
}
