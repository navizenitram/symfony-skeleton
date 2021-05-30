<?php

declare(strict_types=1);

namespace App\Application\Report;


use League\Csv\Exception;
use League\Csv\Writer;

final class ReportCsv implements Report
{

    private Writer $writer;

    public function __construct(string $pathToSave)
    {
        $this->writer = Writer::createFromPath($pathToSave, 'w+');
    }

    public function executeReport(array $data): bool
    {
        try {
            $this->writer->insertOne(
                ['time', 'Elevator 1:Floor:Counter', 'Elevator 2:Floor:Counter', 'Elevator 2:Floor:Counter']
            );
            $records = [];
            foreach ($data['times'] as $time => $row) {
                $records[] = [$time, $row[0], $row[1], $row[2]];
            }

            foreach ($data['counters'] as $elevatorId => $counter) {
                $records[] = [sprintf("Elevator %d: %d floors", $elevatorId, $counter)];
            }


            foreach ($data['warnings'] as $time => $journeys) {
                $records[] = [$time, sprintf("%d journeys at the same time", $journeys)];
            }

            $this->writer->insertAll($records);
        } catch (Exception $e) {
            //TODO Implement logger
            return false;
        }

        return true;
    }


}