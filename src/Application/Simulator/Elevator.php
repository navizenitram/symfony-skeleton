<?php

declare(strict_types=1);

namespace App\Application\Simulator;

final class Elevator
{
    private int $elevatorId;
    private int $currentFloor;
    private int $floorCounter;


    public function __construct(
        int $elevatorId,
        int $currentFloor = 0,
        int $floorCounter = 0
    ) {
        $this->elevatorId = $elevatorId;
        $this->currentFloor = $currentFloor;
        $this->floorCounter = $floorCounter;
    }

    /**
     * @return int
     */
    public function getElevatorId(): int
    {
        return $this->elevatorId;
    }

    /**
     * @return int
     */
    public function getCurrentFloor(): int
    {
        return $this->currentFloor;
    }

    /**
     * @param int $currentFloor
     */
    public function setCurrentFloor(int $currentFloor): void
    {
        $this->currentFloor = $currentFloor;
    }

    /**
     * @return int
     */
    public function getFloorCounter(): int
    {
        return $this->floorCounter;
    }

    /**
     * @param int $floorCounter
     */
    public function incrementFloorCounter(int $floorCounter): void
    {
        $this->floorCounter += $floorCounter;
    }


}