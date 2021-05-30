<?php

declare(strict_types=1);

namespace App\Application\Simulator;

use DateInterval;
use DateTime;

final class ElevatorSequence
{
    private $sequenceId;
    private $interval;
    private $fromTime;
    private $toTime;
    private $fromFloor;
    private $toFloor;
    private $runTime;

    public function __construct(
        int $sequenceId,
        int $interval,
        DateTime $fromTime,
        DateTime $toTime,
        array $fromFloor,
        array $toFloor
    ) {
        $this->sequenceId = $sequenceId;
        $this->interval = $interval;
        $this->fromTime = $fromTime;
        $this->toTime = $toTime;
        $this->fromFloor = $fromFloor;
        $this->toFloor = $toFloor;
        $this->runTime = $fromTime->add(new DateInterval('PT' . $interval . 'M'));
    }

    /**
     * @return DateTime
     */
    public function getRunTime(): DateTime
    {
        return $this->runTime;
    }

    /**
     * @param \DateTimeInterface $currenTime
     * @throws \Exception
     */
    public function moveToNextRunTime(\DateTimeInterface $currenTime): void
    {
        $this->runTime = $currenTime->add(new DateInterval('PT' . $this->interval . 'M'));
    }
    /**
     * @return int
     */
    public function getSequenceId(): int
    {
        return $this->sequenceId;
    }

    /**
     * @return int
     */
    public function getInterval(): int
    {
        return $this->interval;
    }

    /**
     * @return DateTime
     */
    public function getFromTime(): DateTime
    {
        return $this->fromTime;
    }

    /**
     * @return DateTime
     */
    public function getToTime(): DateTime
    {
        return $this->toTime;
    }

    /**
     * @return array
     */
    public function getFromFloor(): array
    {
        return $this->fromFloor;
    }

    /**
     * @return array
     */
    public function getToFloor(): array
    {
        return $this->toFloor;
    }

}