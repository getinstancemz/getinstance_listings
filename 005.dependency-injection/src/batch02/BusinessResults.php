<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch02;

use gi\lazy\phpdi\batch01\ListingSet;

/* listing 005.02 */
class BusinessResults
{
    private ListingSet $listings;

    public function __construct()
    {
        $reg = Registry::inst();
        $this->listings = $reg->getListings();
    }

/* /listing 005.02 */
    public function getListings()
    {
        return $this->listings;
    }
/* listing 005.02 */
}
