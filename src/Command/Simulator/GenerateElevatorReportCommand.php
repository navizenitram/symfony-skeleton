<?php

namespace App\Command\Simulator;

use App\Application\Report\ReportCsv;
use App\Application\Simulator\Elevator;
use App\Application\Simulator\ElevatorSequence;
use App\Application\Simulator\Simulator;
use App\Application\Simulator\SimulatorRequest;
use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateElevatorReportCommand extends Command
{
    protected static $defaultName = 'bodas:elevator:report';

    protected function configure()
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'File to save report')
             ->setDescription("Generate Elevator Report in CSV");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $fileName = $input->getArgument('file');
        } catch (InvalidArgumentException $e) {
            $output->writeln($e->getMessage());
            return 1;
        }

        $simulatorRequest = new SimulatorRequest();

        $simulatorRequest->setStartTime(new DateTime('09:00'));
        $simulatorRequest->setEndTime(new DateTime('20:00'));

        $simulatorRequest->addElevator(new Elevator(1));
        $simulatorRequest->addElevator(new Elevator(2));
        $simulatorRequest->addElevator(new Elevator(3));

        $sequenceId = 1;
        $intervalInMinutes = 5;
        $fromTime = new DateTime('09:00');
        $toTime = new DateTime('11:00');
        $fromFloor = [0];
        $toFloor = [2];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );

        $sequenceId = 2;
        $intervalInMinutes = 10;
        $fromTime = new DateTime('09:00');
        $toTime = new DateTime('10:00');
        $fromFloor = [0];
        $toFloor = [1];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );


        $sequenceId = 3;
        $intervalInMinutes = 20;
        $fromTime = new DateTime('11:00');
        $toTime = new DateTime('18:20');
        $fromFloor = [0];
        $toFloor = [1, 2, 3];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );

        $sequenceId = 4;
        $intervalInMinutes = 4;
        $fromTime = new DateTime('14:00');
        $toTime = new DateTime('15:00');
        $fromFloor = [1, 2, 3];
        $toFloor = [0];
        $simulatorRequest->addElevatorSequence(
            new ElevatorSequence(
                $sequenceId, $intervalInMinutes, $fromTime, $toTime,
                $fromFloor, $toFloor
            )
        );

        $reportCsv = new ReportCsv($fileName);
        $simulator = new Simulator($reportCsv);
        $simulatorResponse = $simulator->execute($simulatorRequest);


        return $simulatorResponse->getResultCode();
    }
}