<?php

declare(strict_types=1);

namespace App\Application\Simulator;

final class Elevator
{
    private $elevatorId;
    private $currentFloor;
    private $lastFloor;
    private $isFree;
    private $floorCounter;

    public function __construct(
        int $elevatorId,
        int $currentFloor = 0,
        int $lastFloor = 0,
        bool $isFree = true,
        int $floorCounter = 0
    ) {
        $this->elevatorId = $elevatorId;
        $this->currentFloor = $currentFloor;
        $this->lastFloor = $lastFloor;
        $this->isFree = $isFree;
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
    public function getLastFloor(): int
    {
        return $this->lastFloor;
    }

    /**
     * @param int $lastFloor
     */
    public function setLastFloor(int $lastFloor): void
    {
        $this->lastFloor = $lastFloor;
    }

    /**
     * @return bool
     */
    public function isFree(): bool
    {
        return $this->isFree;
    }

    /**
     * @param bool $isFree
     */
    public function setIsFree(bool $isFree): void
    {
        $this->isFree = $isFree;
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
    public function setFloorCounter(int $floorCounter): void
    {
        $this->floorCounter = $floorCounter;
    }

}