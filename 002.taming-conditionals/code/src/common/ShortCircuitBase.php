<?php

namespace gi\lazy\conditionals\common;

abstract class ShortCircuitBase {

    public abstract function renderRoom(string $name): string;
    
    public function roomError(string $name): string
    {
        return "error";
    }

    public function doRender(string $room): string
    {
        return "success";
    }

    public function getRoom(string $name): string|bool
    {
        if (in_array($name, ["living", "bed"])) {
            return $name;
        }
        return false;
    }
    
}

