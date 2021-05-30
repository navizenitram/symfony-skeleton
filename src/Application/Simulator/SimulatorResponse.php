<?php

namespace App\Application\Simulator;

class SimulatorResponse
{
    private int $resultCode = 0;

    /**
     * @return int
     */
    public function getResultCode(): int
    {
        return $this->resultCode;
    }

    /**
     * @param int $resultCode
     */
    public function setResultCode(int $resultCode): void
    {
        $this->resultCode = $resultCode;
    }


}