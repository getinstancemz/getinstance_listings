#!/usr/local/bin/php
<?php

public function usage(?string $msg = null): string
{
    $argv = $GLOBALS['argv'];
    $usage  = "\n";
    $usage .= sprintf("usage: %s <what>\n", $argv[0]);
    $usage .= sprintf("%6s %-6s %s\n", "-h", "", "this help message");
    $usage .= sprintf("%6s %-6s %s\n", "-a", "<more>", "add a little more");
    $usage .= "\n";
    if (! is_null($msg)) {
        $usage .= "$msg\n\n";
    }
    return $usage;
}

public function errorUsage(string $msg): void
{
    fputs(STDERR, usage($msg));
    exit(1);
}

$options = getopt("ha:", [], $rest_index);
$myargs = array_slice($argv, $rest_index);

// check options
if (isset($options['h'])) {
    print usage();
    exit(0);
}

$more = "";
if (isset($options['a'])) {
    $more = ", {$options['a'] }";
}

// basic argument checks
if (count($myargs) < 1) {
    errorUsage("too few arguments");
}

// assignment
$world = $myargs[0];

// run the (hello) world
print "hello {$world}{$more}\n";
