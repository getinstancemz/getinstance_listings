<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch01;

class BatchRunner
{
    public function run1()
    {
        $bres = new BusinessResults();
        return $bres->getListings();
    }
}
