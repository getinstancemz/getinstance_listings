<?php
/* listing 010.06 */
require_once(__DIR__ . "/../vendor/autoload.php");
use getinstance\utils\aibasic\control\Runner;

$runner = new Runner();

$str = "I am writing an article about GPT. I use the heading 'Hello, Hal' several times. What do you understand by this heading?";

print $runner->askAi($str);

