<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch02;

use gi\lazy\phpdi\batch01\ListingSet;

class Registry
{
    private static Registry $inst;

    private function __construct()
    {
    }
    
    public static function inst(): self
    {
        if (empty(self::$inst)) {
            self::$inst = new self();
        }
        return self::$inst;
    }

    public function getListings(): ListingSet
    {
        return new ListingSet();
    }
}
