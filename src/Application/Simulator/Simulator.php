<?php

declare(strict_types=1);

namespace App\Application\Simulator;

use DateInterval;
use DatePeriod;

final class Simulator
{

    public function execute(SimulatorRequest $request): SimulatorResponse
    {
        $response = new SimulatorResponse();
        $report = [];


        $interval = DateInterval::createFromDateString('1 minute');
        $period = new DatePeriod($request->getStartTime(), $interval, $request->getEndTime());

        foreach ($period as $currentTime) {
            //$currentTime ->format("H:i\n");
            $concurrentSequences = [];
            /** @var  ElevatorSequence $elevatorSequence */
            foreach ($request->getElevatorSequences() as $elevatorSequence) {

                /*echo $elevatorSequence->getSequenceId()."]".$currentTime ->format("H:i")."---"
                    .$elevatorSequence->getRunTime()->format
                    ("H:i").PHP_EOL;*/


                if($this->isSequenceActive($elevatorSequence, $currentTime)){

                        if($currentTime == $elevatorSequence->getRunTime()){

                            $concurrentSequences[] = $elevatorSequence;
                        }

                }
            }

            /** @var Elevator $elevator */
            $elevatorNeeded = count($concurrentSequences);


            foreach ($concurrentSequences as $elevatorSequence) {

                echo "Secuencia:". $elevatorSequence->getSequenceId(). "[" .$elevatorSequence->getRunTime()
                                                                                             ->format("H:i"). "]"
                    .PHP_EOL;

                foreach ($elevatorSequence->getFromFloor() as $fromFloorNumber) {
                    foreach ($request->getElevators() as $elevator) {
                        foreach ($elevatorSequence->getToFloor() as $toFloorNumber) {

                        }
                    }
                }




                $elevatorSequence->moveToNextRunTime($currentTime);
            }



        }


        return $response;
    }

    /**
     * @param ElevatorSequence $elevatorSequence
     * @param \DateTimeInterface $currentTime
     * @return bool
     */
    private function isSequenceActive(ElevatorSequence $elevatorSequence, \DateTimeInterface $currentTime): bool
    {
        return $currentTime >= $elevatorSequence->getFromTime() && $currentTime <= $elevatorSequence->getToTime();
    }
}