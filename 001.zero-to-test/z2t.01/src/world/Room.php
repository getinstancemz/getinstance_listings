<?php

declare(strict_types=1);

/* listing 001.01   */

namespace thehouse\world;

class Room
{
    public function __construct(public string $name, public string $description)
    {
    }

    public function __toString()
    {
        return "{$this->name}: {$this->description}";
    }
}
/* /listing 001.01   */

return;

/* listing 001.02   */
$name = "Main bedroom";
$desc = "An old-fashioned darkly-paneled bedroom with a four-poster bed";
$room = new Room($name, $desc);
print $room->name . "\n";
print $room->description . "\n";
/* /listing 001.02   */
