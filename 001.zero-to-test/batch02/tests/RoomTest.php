<?php declare(strict_types=1);
namespace thehouse\tests;
use thehouse\world\Room;

use PHPUnit\Framework\TestCase;

final class RoomTest extends TestCase
{
    private string $desc;
    private string $name;
    private Room $room;

    public function setUp(): void
    {
        $this->desc = "An old fashioned darkly-paneled bedroom with a four-poster bed";
        $this->name = "main bedroom";
        $this->room = new Room($this->name, $this->desc);
    }

    public function testGetters(): void
    {
        $this->assertEquals($this->name, $this->room->name, "Name is incorrect");

        // uncomment below to make the test fail as in listing 001.14
        // $this->assertEquals($this->desc, $this->room->description, "Description is incorrect");
    }

    public function testToString(): void
    {
        // uncomment below to make the test fail as in listing 001.14
        // $this->assertEquals("{$this->name}: {$this->desc}", "{$this->room}", "__toString() value is incorrect");
        $this->assertTrue(true);
    }
}

