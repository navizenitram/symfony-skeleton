<?php

namespace App\Application\Simulator;

use App\Application\Report\ReportEcho;
use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;

class SimulatorTest extends TestCase
{
    public function testShouldSomething()
    {
        $simulatorRequest = new SimulatorRequest();

        $simulatorRequest->setStartTime(new DateTime('09:00'));
        $simulatorRequest->setEndTime(new DateTime('20:00'));

        $simulatorRequest->addElevator(new Elevator(1));
        $simulatorRequest->addElevator(new Elevator(2));
        $simulatorRequest->addElevator(new Elevator(3));

        $sequenceId = 1;
        $intervalInMinutes = 5;
        $fromTime = new DateTime('09:00');
        $toTime = new DateTime('11:00');
        $fromFloor = [0];
        $toFloor = [2];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );

        $sequenceId = 2;
        $intervalInMinutes = 10;
        $fromTime = new DateTime('09:00');
        $toTime = new DateTime('10:00');
        $fromFloor = [0];
        $toFloor = [1];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );


        $sequenceId = 3;
        $intervalInMinutes = 20;
        $fromTime = new DateTime('11:00');
        $toTime = new DateTime('18:20');
        $fromFloor = [0];
        $toFloor = [1,2,3];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );

        $sequenceId = 4;
        $intervalInMinutes = 4;
        $fromTime = new DateTime('14:00');
        $toTime = new DateTime('15:00');
        $fromFloor = [1,2,3];
        $toFloor = [0];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );

        $simulator = new Simulator(new ReportEcho());
        $simulatorResponse = $simulator->execute($simulatorRequest);

        $this->assertSame(0, $simulatorResponse->getResultCode());

    }

}