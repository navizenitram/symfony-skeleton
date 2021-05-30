<?php

declare(strict_types=1);

namespace App\Application\Simulator;

use DateTime;

final class SimulatorRequest
{
    private $startTime;
    private $endTime;
    private $elevators = [];
    private $elevatorSequences = [];

    /**
     * @return DateTime
     */
    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    /**
     * @param DateTime $startTime
     */
    public function setStartTime(DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return DateTime
     */
    public function getEndTime(): DateTime
    {
        return $this->endTime;
    }

    /**
     * @param DateTime $endTime
     */
    public function setEndTime(DateTime $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return array
     */
    public function getElevators(): array
    {
        return $this->elevators;
    }

    /**
     * @param Elevator $elevator
     */
    public function addElevator(Elevator $elevator): void
    {
        $this->elevators[] = $elevator;
    }

    /**
     * @return array
     */
    public function getElevatorSequences(): array
    {
        return $this->elevatorSequences;
    }

    /**
     * @param ElevatorSequence $elevatorSequence
     */
    public function addElevatorSequence(ElevatorSequence $elevatorSequence): void
    {
        $this->elevatorSequences[] = $elevatorSequence;
    }

}