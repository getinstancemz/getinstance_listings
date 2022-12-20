<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch04;

use gi\lazy\phpdi\batch01\ListingSet;

/* listing 005.09 */
class BusinessResults
{
    private string $title;
    private ListingSet $listings;

    public function __construct(string $title, ListingSet $listings)
    {
        $this->title = $title;
        $this->listings = $listings;
    }
/* /listing 005.09 */
    public function getListings()
    {
        return $this->listings;
    }
/* listing 005.09 */
}
