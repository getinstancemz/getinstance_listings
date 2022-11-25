<?php

namespace gi\lazy\conditionals\after;

/* listing 002.16 */
class FileOutput extends Output {
    public function __construct(private string $path) {
    }

    public function out(string $str): void {
        \file_put_contents($this->path, $str, \FILE_APPEND);
    }
}

