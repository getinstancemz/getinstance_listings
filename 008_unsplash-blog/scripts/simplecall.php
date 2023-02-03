<?php

/* listing 008.09 */
require_once(__DIR__ . "/vendor/autoload.php");
use getinstance\utils\apitools\UnsplashWriter;

$access = "xxxx";
$appname = "getinstance-blog-autopic";
$blogdir = "./output";

$writer = new UnsplashWriter("Ty4QBwHJfrk", $access, $appname);
$url = $writer->writeImage($blogdir, 400, "titchy");

print "![{$writer->getDescription()}]($url)";
print "\n\n\n";
print $writer->getAttrib() . "\n";
