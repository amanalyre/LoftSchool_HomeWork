<?php

namespace Homework_4;


interface InterfaceTariff
{
    public function calcRidePrice($driverAge, $km, $minutes, $pricePerKM, $pricePerMinute);
}