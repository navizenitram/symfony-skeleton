<?php

namespace App\Application\Report;

class ReportEcho implements Report
{

    public function executeReport(array $data): bool
    {
        echo " ****** Time | Elevator : Floor: Floor Counter ***** ". PHP_EOL;
        foreach ($data['times'] as $time=>$row) {
            echo $time .' | '. implode(",", $row). PHP_EOL;
        }
        echo " ****** Total Floors by elevator ***** ". PHP_EOL;
        foreach ($data['counters'] as $elevatorId=>$counter) {
            echo sprintf("Elevator %d: %d floors", $elevatorId, $counter). PHP_EOL;
        }

        echo " ****** Warnings: More journeys than elevators at the same time ***** ". PHP_EOL;
        foreach ($data['warnings'] as  $time=>$journeys)  {
        echo $time .' | '. sprintf("%d journeys at the same time", $journeys). PHP_EOL;
        }

        return true;
    }
}