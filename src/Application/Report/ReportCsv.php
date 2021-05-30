<?php

namespace App\Application\Report;

class ReportCsv implements Report
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function executeReport(array $data): bool
    {

    }


}