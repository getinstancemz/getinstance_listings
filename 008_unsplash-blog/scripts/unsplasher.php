#!/usr/local/bin/php
<?php

require_once(__DIR__ . "/vendor/autoload.php");
use getinstance\utils\apitools\UnsplashWriter;

public function usage(?string $msg = null): string
{
    $argv = $GLOBALS['argv'];
    $usage  = "\n";
    $usage .= sprintf("usage: %s <unsplashid> <outputdir>\n", $argv[0]);
    $usage .= sprintf("%6s %-15s %s\n", "-h", "", "This help message");
    $usage .= sprintf("%6s %-15s %s\n", "-c", "<unpslashkey>", "Your Unsplash conf file");
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

$options = getopt("hc:k:", [], $rest_index);
$myargs = array_slice($argv, $rest_index);

// check options
if (isset($options['h'])) {
    print usage();
    exit(0);
}

$dirs = [getcwd(), __DIR__, "{$_SERVER['HOME']}/conf", "/etc"];
if (isset($options['c'])) {
    $conffile = $options['c'];
    if (! is_file($options['c'])) {
        errorUsage("no file at '{$conffile}'");
    }
} else {
    foreach ($dirs as $dir) {
        $path = "{$dir}/gitools.json";
        if (file_exists($path)) {
            $conffile = $path;
        }
    }
    if (is_null($conffile)) {
        errorUsage("no conf file found.");
    }
}

$confvals = json_decode(file_get_contents($conffile), true);

if (
    ! isset($confvals['unsplash']['access']) ||
    ! isset($confvals['unsplash']['appname'])
) {
    errorUsage("expecting config values for unsplash: access, appname");
}

// basic argument checks
if (count($myargs) < 2) {
    errorUsage("too few arguments");
}

// assignment
$imageid = $myargs[0];
$outputdir = $myargs[1];

$writer = new UnsplashWriter(
    $imageid,
    $confvals['unsplash']['access'],
    $confvals['unsplash']['appname']
);

$small = $writer->writeImage($outputdir, 400, "small");
$medium = $writer->writeImage($outputdir, 800, "med");
$large = $writer->writeImage($outputdir, 1023, "large");

print "\n";
print "image: {$medium}" . "\n";
print "teaser: {$small}" . "\n\n";
print "![{$writer->getDescription()}]($large)\n\n";
print $writer->getAttrib() . "\n\n";
