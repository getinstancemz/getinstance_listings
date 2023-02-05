<?php

namespace getinstance\utils\storyai\storymodel;

interface IdFinder {
    private string $id;

    public function __construct(string $id) {
        $this->id = $id;
    }

    public function visit(PlotPoint $plotpoint) {
    }
}
