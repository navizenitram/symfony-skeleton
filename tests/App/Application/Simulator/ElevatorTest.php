<?php

namespace App\Application\Simulator;

use PHPUnit\Framework\TestCase;

class ElevatorTest extends TestCase
{
    public function testFloorIncrement() {
        $elevator = new Elevator(1);
        $elevator->incrementFloorCounter(2);
        $expected = 2;
        $this->assertSame($expected, $elevator->getFloorCounter());

        $elevator = new Elevator(1,2,4);
        $elevator->incrementFloorCounter(2);
        $expected = 6;
        $this->assertSame($expected, $elevator->getFloorCounter());
    }
}