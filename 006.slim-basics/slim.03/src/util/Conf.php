<?php

/* listing 006.12 */
namespace getinstance\myapp\util;

class Conf
{
    public function __construct(private array $data)
    {
    }

    public function get($key): mixed
    {
        return ($this->data[$key] ?? null);
    }
}
