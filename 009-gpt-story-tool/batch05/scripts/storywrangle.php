#!/usr/local/bin/php
<?php
# listing 009.26

require_once(__DIR__ . "/../vendor/autoload.php");

use getinstance\utils\storyai\cli\StartCmd;
use getinstance\utils\storyai\cli\StatusCmd;
use getinstance\utils\storyai\cli\AskCmd;
use getinstance\utils\storyai\cli\AddCmd;
use getinstance\utils\storyai\cli\DelCmd;
use getinstance\utils\storyai\cli\GoCmd;
use getinstance\utils\storyai\cli\TellCmd;

function usage(?string $msg = null): string
{
    $argv = $GLOBALS['argv'];
    $usage  = "\n";
    $usage .= sprintf("usage: %s <subcommand>\n", $argv[0]);
    $usage .= sprintf("    <storytag> start <genre> <prompt>\n");
    $usage .= sprintf("    <storytag> tell\n");
    $usage .= sprintf("    <storytag> status\n");
    $usage .= sprintf("    <storytag> ask\n");
    $usage .= sprintf("    <storytag> delete <id>\n");
    $usage .= sprintf("    <storytag> go <id>\n");
    $usage .= "\n";
    if (! is_null($msg)) {
        $usage .= "$msg\n\n";
    }
    return $usage;
}

function errorUsage(string $msg): void
{
    fputs(STDERR, usage($msg));
    exit(1);
}
// basic argument checks
if (count($argv) < 3) {
    errorUsage("too few arguments");
}

$storytag = $argv[1];
$subcommand = $argv[2];

$rest_index = 3;
$subargs = array_slice($argv, $rest_index);
array_unshift( $subargs, $storytag);

if ($subcommand == "start") {
    $cmdobj = new StartCmd($subargs);
} else if ($subcommand == "status") {
    $cmdobj = new StatusCmd($subargs);
} else if ($subcommand == "ask") {
    $cmdobj = new AskCmd($subargs);
} else if ($subcommand == "add") {
    $cmdobj = new AddCmd($subargs);
} else if ($subcommand == "delete") {
    $cmdobj = new DelCmd($subargs);
} else if ($subcommand == "go") {
    $cmdobj = new GoCmd($subargs);
} else if ($subcommand == "tell") {
    $cmdobj = new TellCmd($subargs);
} else {
    errorUsage("unknown subcommand '$subcommand'");
}

try {
    $cmdobj->run($subargs);
} catch (\Exception $e) {
    errorUsage($e->getMessage());
}
