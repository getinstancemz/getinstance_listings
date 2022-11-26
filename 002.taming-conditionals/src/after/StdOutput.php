<?php

namespace gi\lazy\conditionals\after;

/* listing 002.15 */
class StdOutput extends Output {
    public function out(string $str): void {
        print $str;
    }
}

