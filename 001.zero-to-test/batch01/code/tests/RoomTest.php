<?php

declare(strict_types=1);

namespace thehouse\tests;

use thehouse\world\Room;
use PHPUnit\Framework\TestCase;

final class RoomTest extends TestCase
{
    public function testGetters(): void
    {
        $name = "main bedroom";
        $desc = "An old fashioned darkly-paneled bedroom with a four-poster bed";
        $room = new Room($name, $desc);
        $this->assertTrue($room->name == $name);
        $this->assertEquals($desc, $room->description);
    }

    public function testToString(): void
    {
        $name = "Main bedroom";
        $desc = "An old fashioned darkly-paneled bedroom with a four-poster bed";
        $room = new Room($name, $desc);
        $this->assertEquals("$name: $desc", "{$room}");
    }
}
