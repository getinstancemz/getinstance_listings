#!/usr/local/bin/php
<?php

/* listing 004.06 */
function usage(?string $msg=null): string
{
    $argv = $GLOBALS['argv']; 
    $usage  = "\n";
    $usage .= sprintf("usage: %s <directory>\n", $argv[0]);
    $usage .= sprintf("%6s %-6s %s\n", "-h", "",      "this help message");
    $usage .= sprintf("%6s %-6s %s\n", "-a", "",      "count all files including hidden");
    $usage .= sprintf("%6s %-6s %s\n", "-p", "<pat>", "apply regexp pattern");
    $usage .= "\n";
    if (! is_null($msg)) {
        $usage .= "$msg\n\n";
    }
    return $usage;
}
/* /listing 004.06 */

/* listing 004.09 */
function errorUsage(string $msg): void
{
    fputs(STDERR, usage($msg)); 
    exit(1);
}
/* /listing 004.09 */

/* listing 004.10 */
$options = getopt("hap:", [], $rest_index);
$myargs = array_slice($argv, $rest_index);

if (isset($options['h'])) {
    print usage();
    exit(0);
}
$pattern = (isset($options['p']))?preg_quote($options['p'], "/"):null;
$countall = (isset($options['a']))?true:false;
/* /listing 004.10 */

/* listing 004.14 */
// basic argument checks
if (count($myargs) < 1) {
    errorUsage("too few arguments");
}

// assignment 
$dir = $myargs[0];

// more details argument checks
if (! is_dir($dir)) {
    errorUsage("'{$dir}' is not a directory");
}
/* /listing 004.14 */

/* listing 004.15 */
$di = new DirectoryIterator($dir);
$count = 0;
foreach ($di as $fileinfo) {
    if ($fileinfo->getFilename() == ".") {
        continue;
    }
    if ($fileinfo->isDot() && ! $countall) {
        continue;
    }
    if (! empty($pattern)) {
        if (! preg_match("/{$pattern}/", $fileinfo->getFilename())) {
            continue;
        }
    }
    $count++;
}

print "{$dir} contains {$count} files and directories";
if (! empty($pattern)) {
    print " matching regexp pattern '{$pattern}'";
}
print "\n";

/* /listing 004.15 */
