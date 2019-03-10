<?php

namespace Homework_4;


trait withGPSTrait
{
    public function calcGPSCost($secondsSpent) :int
    {
        $hoursSpent = ceil($secondsSpent / 3600);

        return $gpsCost = $hoursSpent * 15;
    }
//gps в салон - 15 рублей в час, минимум 1 час. Округление в большую сторону.
}