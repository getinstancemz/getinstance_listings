<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch03;

use gi\lazy\phpdi\batch01\ListingSet;

/* listing 005.03 */
class BusinessResults
{
    private ListingSet $listings;
/* /listing 005.03 */
    public static int $instno=0;
/* listing 005.03 */

    public function __construct(ListingSet $listings)
    {
        $this->listings = $listings;
/* /listing 005.03 */
        self::$instno++;
/* listing 005.03 */
    }

/* /listing 005.03 */
    public function getListings()
    {
        return $this->listings;
    }
/* listing 005.03 */
}
