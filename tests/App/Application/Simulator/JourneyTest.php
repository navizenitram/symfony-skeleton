<?php

namespace App\Application\Simulator;

use PHPUnit\Framework\TestCase;

class JourneyTest extends TestCase
{
    public function testShouldFailIfFromToAreTheSame()
    {
        $this->expectException(InvalidJourneyException::class);
        $journey = new Journey(0, 0);

    }

    public function testShouldFailIfFloorIsNotAvailable() {

        $this->expectException(InvalidFloorException::class);
        $journey = new Journey(0, 6);
    }

    public function testShouldCheckTheJourney() {
        $this->journeyChecker(0,3,3);
        $this->journeyChecker(3,0,3);
        $this->journeyChecker(1,2,1);
        $this->journeyChecker(2,1,1);
    }

    private function journeyChecker(int $from, int $to, int $expectedResult): void
    {
        $journey = new Journey($from, $to);
        $this->assertSame($expectedResult, $journey->getFloors());
    }
}