<?php

namespace Homework_4;


interface InterfaceTariff
{
    public function calcRidePrice(
            $youthCoefficient,
            $km,
            $minutes,
            $pricePerKM,
            $pricePerMinute,
            $gpsCost,
            $addDriver
    );
}