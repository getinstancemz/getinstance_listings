<?php declare(strict_types=1);

namespace thehouse\world;

class Room 
{
    public function __construct(public string $name, public string $desc)
    {
    }

    public function __toString() {
        return "{$this->name}: {$this->description}"; 
    }
}
