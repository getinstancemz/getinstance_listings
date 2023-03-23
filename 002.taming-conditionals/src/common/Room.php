<?php

namespace gi\lazy\conditionals\common;

class Room
{
    public bool $flooded = false;
    public bool $enchanted = false;
    public bool $dark = false;

    public function isFlooded(): bool
    {
        return $this->flooded;
    }

    public function isTooDark(): bool
    {
        return $this->dark;
    }

    public function isEnchanted(): bool
    {
        return $this->enchanted;
    }

    public function getDescription(): string
    {
        $str = <<<DESC
        A bright clean room with a skylight and a neat bunkbed.

        There is an exit in the north wall, and a small hatch set into the ceiling
DESC;
        return $str;
    }
}
