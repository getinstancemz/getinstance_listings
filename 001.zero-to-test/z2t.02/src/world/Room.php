<?php

declare(strict_types=1);

/* listing 001.13  */
namespace thehouse\world;

class Room
{
    public function __construct(public string $name, public string $desc)
    {
    }

    public function __toString(): string
    {
        return "{$this->name}: {$this->description}";
    }
}
