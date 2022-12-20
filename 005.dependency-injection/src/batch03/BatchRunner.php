<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch03;

use gi\lazy\phpdi\batch01\ListingSet;

class BatchRunner
{
    private $container;
    public function run1()
    {
/* listing 005.04 */
        $listingset = new ListingSet();
        $bres = new BusinessResults($listingset);
/* /listing 005.04 */
        return [$bres, $bres->getListings()];
    }

    private function getSavedContainer(): \DI\Container
    {
        if (empty($this->container)) {
            $this->container = new \DI\Container();
        }
        return $this->container;
    }
    public function run2()
    {
/* listing 005.06 */
        $container = new \DI\Container();
/* /listing 005.06 */
        // actually use a shared container to test instantiation count
        $container = $this->getSavedContainer();
/* listing 005.06 */
        $bres = $container->get(BusinessResults::class);
/* /listing 005.06 */
        return [$bres, $bres->getListings()];
    }

    public function run3()
    {
/* listing 005.07 */
        $container = new \DI\Container();
        if ($container->has(BusinessResults::class)) {
            return true;
        }
        return false;
/* /listing 005.07 */
        return $bres->getListings();
    }

    public function run4()
    {
/* listing 005.08 */
        $container = new \DI\Container();
/* /listing 005.08 */
        // actually use a shared container to test instantiation count
        $container = $this->getSavedContainer();
/* listing 005.08 */
        $bres = $container->make(BusinessResults::class);
/* /listing 005.08 */
        return [$bres, $bres->getListings()];
    }

}
