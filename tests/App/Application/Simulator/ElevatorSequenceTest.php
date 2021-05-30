<?php

namespace App\Application\Simulator;

use DateTime;
use PHPUnit\Framework\TestCase;

class ElevatorSequenceTest extends TestCase
{
    public function testGetJourneysOneItem()
    {
        $sequenceId = 1;
        $intervalInMinutes = 5;
        $fromTime = new DateTime('09:00');
        $toTime = new DateTime('11:00');
        $fromFloor = [0];
        $toFloor = [2];
        $elevatorSequence = new ElevatorSequence(
            $sequenceId, $intervalInMinutes, $fromTime, $toTime,
            $fromFloor, $toFloor
        );

        $journeys = $elevatorSequence->getJourneys();
        $this->assertArrayHasKey(0,$journeys);
        $expectedJourneys = new Journey(0, 2);
        $this->assertSame($expectedJourneys->getFloors(), $journeys[0]->getFloors());
        $this->assertSame($expectedJourneys->getFrom(), $journeys[0]->getFrom());
        $this->assertSame($expectedJourneys->getTo(), $journeys[0]->getTo());
    }

    public function testGetJourneysMoreThanOneJourneyItem()
    {
        $sequenceId = 1;
        $intervalInMinutes = 5;
        $fromTime = new DateTime('09:00');
        $toTime = new DateTime('11:00');
        $fromFloor = [0];
        $toFloor = [2,3];
        $elevatorSequence = new ElevatorSequence(
            $sequenceId, $intervalInMinutes, $fromTime, $toTime,
            $fromFloor, $toFloor
        );

        $journeys = $elevatorSequence->getJourneys();
        $this->assertCount(2, $journeys);
        $expectedJourney1 = new Journey(0, 2);

        $this->assertSame($expectedJourney1->getFloors(), $journeys[0]->getFloors());
        $this->assertSame($expectedJourney1->getFrom(), $journeys[0]->getFrom());
        $this->assertSame($expectedJourney1->getTo(), $journeys[0]->getTo());

        $expectedJourney2 = new Journey(0, 3);

        $this->assertSame($expectedJourney2->getFloors(), $journeys[1]->getFloors());
        $this->assertSame($expectedJourney2->getFrom(), $journeys[1]->getFrom());
        $this->assertSame($expectedJourney2->getTo(), $journeys[1]->getTo());

    }
}