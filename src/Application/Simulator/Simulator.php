<?php

declare(strict_types=1);

namespace App\Application\Simulator;

use App\Application\Report\Report;
use DateInterval;
use DatePeriod;
use DateTimeInterface;

final class Simulator
{


    private Report $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function execute(SimulatorRequest $request): SimulatorResponse
    {
        $response = new SimulatorResponse();

        $report = [];

        /** @var  $elevatorsAvailable */
        $elevatorsAvailable = $request->getElevators();


        $interval = DateInterval::createFromDateString('1 minute');
        $period = new DatePeriod($request->getStartTime(), $interval, $request->getEndTime());

        foreach ($period as $currentTime) {
            $concurrentSequences = [];
            /** @var  ElevatorSequence $elevatorSequence */
            foreach ($request->getElevatorSequences() as $elevatorSequence) {
                if ($this->isSequenceActive($elevatorSequence, $currentTime) &&
                    $currentTime == $elevatorSequence->getRunTime()) {
                        $concurrentSequences[] = $elevatorSequence;
                    }
            }

            $elevatorJourneys = [];
            foreach ($concurrentSequences as $elevatorSequence) {
                /** @var Journey $journey */
                foreach ($elevatorSequence->getJourneys() as $journey) {
                    $elevatorJourneys[] = $journey;
                }

                $elevatorSequence->moveToNextRunTime($currentTime);
            }
            if (!empty($elevatorJourneys) && (count($elevatorJourneys) <= count($elevatorsAvailable))) {
                /** @var Journey $journey */
                $elevatorSelector = 0;
                foreach ($elevatorJourneys as $journey) {
                    /** @var Elevator $currentElevator */
                    $currentElevator = $elevatorsAvailable[$elevatorSelector];
                    if ($currentElevator->getCurrentFloor() !== $journey->getFrom()) {
                        $emptyJourney = new Journey($currentElevator->getCurrentFloor(), $journey->getFrom());
                        $currentElevator->incrementFloorCounter($emptyJourney->getFloors());
                    }
                    $currentElevator->setCurrentFloor($journey->getTo());
                    $currentElevator->incrementFloorCounter($journey->getFloors());

                    $elevatorSelector++;
                    if ($elevatorSelector === count($elevatorsAvailable)) {
                        $elevatorSelector = 0;
                    }
                }
            }

            if (count($elevatorJourneys) > count($elevatorsAvailable)) {
                $report['warnings'][$currentTime->format("H:i")] = count($elevatorJourneys);
            }

            $report['times'][$currentTime->format("H:i")] = $this->generateReportByMinuteAndElevator($elevatorsAvailable);
        }


        foreach ($elevatorsAvailable as $elevator) {
            $report['counters'][$elevator->getElevatorId()] = $elevator->getFloorCounter();
        }

        $reportResult = $this->report->executeReport($report);
        $response->setResultCode((int)!$reportResult);

        return $response;
    }

    /**
     * @param ElevatorSequence $elevatorSequence
     * @param DateTimeInterface $currentTime
     * @return bool
     */
    private function isSequenceActive(ElevatorSequence $elevatorSequence, DateTimeInterface $currentTime): bool
    {
        return $currentTime >= $elevatorSequence->getFromTime() && $currentTime <= $elevatorSequence->getToTime();
    }

    /**
     * @param array $elevatorsAvailable
     * @return array
     */
    private function generateReportByMinuteAndElevator(array $elevatorsAvailable): array
    {

        $reportRow = [];
        /** @var Elevator $elevator */
        foreach ($elevatorsAvailable as $elevator) {
            $reportRow[] =
                $elevator->getElevatorId() .
                ':' .
                $elevator->getCurrentFloor() .
                ':' .
                $elevator->getFloorCounter();
        }


        return $reportRow;

    }
}