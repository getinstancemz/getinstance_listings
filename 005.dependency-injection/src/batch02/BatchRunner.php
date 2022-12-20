<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch02;

use gi\lazy\phpdi\batch01\ListingSet;

class BatchRunner
{
    public function run1(): ListingSet
    {
        $bres = new BusinessResults();
        return $bres->getListings();
    }
}
