<?php

declare(strict_types=1);

namespace gi\lazy\phpdi\batch04;

use gi\lazy\phpdi\batch01\ListingSet;
use Psr\Container\ContainerInterface;

class BatchRunner
{
    public function run1(): void
    {
        $container = new \DI\Container();
        $container->get(BusinessResults::class);
    }

    public function run2(): BusinessResults
    {

/* listing 005.11 */
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions(
            [
                // ...
            /* /listing 005.11 */
                "results.title" => \DI\value("hats!"),
                BusinessResults::class => \DI\autowire(BusinessResults::class)
                    ->constructorParameter("title", "results.title")
            /* listing 005.11 */
            ]
        );
        $container = $builder->build();
/* /listing 005.11 */
        return $container->get(BusinessResults::class);
    }

    public function run3(): BusinessResults
    {
/* listing 005.12 */
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions(
            __DIR__ . "/config.php"
        );
        $container = $builder->build();
/* /listing 005.12 */
        return $container->get(BusinessResults::class);
    }

    public function run4(): string
    {
/* listing 005.14 */
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions(
            [
                "results.title" => \DI\value("hats!"),
            ]
        );
        $container = $builder->build();
        print $container->get("results.title"); // hats!
/* /listing 005.14 */
        return $container->get("results.title");
    }

    public function run5(): BusinessResults
    {

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions(
/* listing 005.17 */
            [
                "results.title" => \DI\value("hats!"),
                BusinessResults::class => \DI\autowire(BusinessResults::class)
                    ->constructorParameter("title", \DI\get("results.title"))
            ]
        );
/* /listing 005.17 */
        $container = $builder->build();
        $bizres = $container->get(BusinessResults::class);
        var_dump($bizres);

        return $bizres;
    }

    public function run6(): BusinessResults
    {

/* listing 005.15 */
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions(
            [
                "results.title" => \DI\value("hats!"),
                BusinessResults::class => \DI\create(BusinessResults::class)
                    ->constructor(\DI\get("results.title"), \DI\get(ListingSet::class))
            ]
        );
        $container = $builder->build();
        $bizres = $container->get(BusinessResults::class);
        var_dump($bizres);
/* /listing 005.15 */

        return $bizres;
    }

    public function run7(): BusinessResults
    {

        $builder = new \DI\ContainerBuilder();
/* listing 005.18 */
        $builder->addDefinitions(
            [
                BusinessResults::class => \DI\factory(
                    function (ContainerInterface $container) {
                        $title = "cheese!";
                        return new BusinessResults($title, $container->get(ListingSet::class));
                    }
                )
            ]
        );
/* /listing 005.18 */

        $container = $builder->build();
        $bizres = $container->get(BusinessResults::class);
        var_dump($bizres);

        return $bizres;
    }
}
