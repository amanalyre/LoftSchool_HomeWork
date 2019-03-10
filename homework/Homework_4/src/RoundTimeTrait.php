<?php

namespace Homework_4;


trait RoundTimeTrait
{
    public function roundIt($timeFromDriver, string $timeType)
    {
        if ($timeType = 'hour') {
            $timeRounded = $timeFromDriver *1; // TODO привести в нормальный вид расчет
        }
    }
}