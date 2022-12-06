#!/usr/local/bin/php
<?php

/* listing 004.01.02 */
function usage(?string $msg=null): string
{
    $argv = $GLOBALS['argv']; 
    $usage  = "\n";
    $usage .= "usage: {$argv[0]} <directory>\n";
    $usage .= "    -h        this help message\n";
    $usage .= "    -a        count all files including hidden\n";
    $usage .= "    -p <pat>  apply regexp pattern\n";
    $usage .= "\n";
    if (! is_null($msg)) {
        $usage .= "$msg\n\n";
    }
    return $usage;
}
/* /listing 004.01.02 */

print usage();
