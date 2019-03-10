<?php

namespace Homework_4;


trait RoundTimeTrait
{
    public function roundIt($timeFromDriver, string $timeType)
    {
        if ($timeType = 'hour') {
            $timeRounded = $timeFromDriver *1;


            // TODO привести в нормальный вид расчет
        } elseif ($timeType = 'day') {
            $maxDayTime = 1470; // 24 часа * 60 минут + 30 минут
            //$timeFromDriver <= $maxDayTime ? $maxDayTime : $maxDayTime * 2;  Bad idea
            $timeRounded = ceil($timeFromDriver / $maxDayTime);

        }
    }
}