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
$room = new Room("Coal cellar", "Very dark and dirty");
print $room->name . "\n";
print $room->description . "\n";
/* /listing 001.02   */
