<?php


declare(strict_types=1);

namespace App\Application\Simulator;

final class Journey
{
    public const AVAILABLE_FLOORS = [0, 1, 2, 3];
    private int $from;
    private int $to;


    public function __construct(int $from, int $to)
    {
        $this->checkJourneyFromTo($from, $to);
        $this->checkIfFloorExist($from);
        $this->checkIfFloorExist($to);

        $this->from = $from;
        $this->to = $to;
    }

    private function checkJourneyFromTo(int $from, int $to)
    {
        if ($from === $to) {
            throw new InvalidJourneyException();
        }
    }

    private function checkIfFloorExist(int $floor)
    {
        if (!in_array($floor, self::AVAILABLE_FLOORS, true)) {
            throw new InvalidFloorException(sprintf('Floor %d is not valid', $floor));
        }
    }

    public function getFloors(): int
    {
        if ($this->from > $this->to) {
            return $this->from - $this->to;
        }

        return $this->to - $this->from;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }


}