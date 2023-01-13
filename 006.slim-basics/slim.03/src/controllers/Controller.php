<?php

/* listing 006.08 */
namespace getinstance\myapp\controllers;

use getinstance\myapp\util\Conf;

abstract class Controller
{
    public function __construct(private Conf $conf)
    {
    }

    public function getConf(): Conf
    {
        return $this->conf;
    }
}
