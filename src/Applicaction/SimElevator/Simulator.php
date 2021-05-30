<?php

declare(strict_types=1);

namespace App\Application\SimElevator;

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

        foreach ($period as $dt) {
            echo $dt->format("H:i\n");
        }



        return $response;

    }
}