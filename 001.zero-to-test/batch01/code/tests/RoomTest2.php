<?php

declare(strict_types=1);

namespace thehouse\tests;

use thehouse\world\Room;
use PHPUnit\Framework\TestCase;

/* listing 001.09 */
final class RoomTest2 extends TestCase
{
    private string $desc;
    private string $name;
    private Room $room;

    public function setUp(): void
    {
        $this->desc = "An old-fashioned darkly-paneled bedroom with a four-poster bed";
        $this->name = "main bedroom";
        $this->room = new Room($this->name, $this->desc);
    }

    public function testGetters(): void
    {
        $this->assertEquals($this->name, $this->room->name, "Name is incorrect");
        $this->assertEquals($this->desc, $this->room->description, "Description is incorrect");
    }

    public function testToString(): void
    {
        $this->assertEquals("{$this->name}: {$this->desc}", "{$this->room}", "__toString() value is incorrect");
    }
}
