<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch01;

/* listing 005.01 */
class BusinessResults
{
    private ListingSet $listings;

    public function __construct()
    {
        $this->listings = new ListingSet();
    }

/* /listing 005.01 */
    public function getListings(): ListingSet
    {
        return $this->listings;
    }
/* listing 005.01 */
}
