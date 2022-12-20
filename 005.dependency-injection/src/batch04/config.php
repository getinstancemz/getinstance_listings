<?php


declare(strict_types=1);

namespace gi\lazy\phpdi\batch04;

/* listing 005.13 */
return [
    // ...
/* /listing 005.13 */
    "results.title" => "hats!",
    BusinessResults::class => \DI\autowire(BusinessResults::class)
        ->constructorParameter("title", "results.title")
/* listing 005.13 */
];
