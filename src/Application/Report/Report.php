<?php


namespace App\Application\Report;


interface Report
{
    public function executeReport(array $data): bool;
}