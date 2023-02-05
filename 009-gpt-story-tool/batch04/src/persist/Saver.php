<?php

namespace getinstance\utils\storyai\persist;
use getinstance\utils\storyai\storymodel\PlotPoint;

class Saver {
    private string $path;

    public function __construct(string $datadir, string $storydir)
    {
        if (! is_dir($datadir)) {
            throw new \Exception("could not find data directory");
        }
        $this->path = "$datadir/$storydir";
    }

    public function save($name, $json): bool {
        file_put_contents("$this->path/{$name}.json", $json);
        return true;
    }

    public function load($name): string {
        return file_get_contents("$this->path/{$name}.json");
    }
}
