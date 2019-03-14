<?php

namespace Homework_4_2;


trait WithGPSTrait
{
    /**
     * @param $minutesSpent
     * @return int
     */
    public function calculateGPSCost($minutesSpent): int
    {
        if ($this->isWithGPS) {
            $this->gpsCost = ceil($minutesSpent / 60) * 15;
        } else {
            $this->gpsCost = 0;
        }

        return $this->gpsCost;
    }
}

