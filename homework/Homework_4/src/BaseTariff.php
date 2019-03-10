<?php

namespace Homework_4;


class BaseTariff extends AbstractTariffClass
{
    use WithGPSTrait;

    protected $pricePerKM = 10;
    protected $pricePerMinute = 3;



    public function calcRidePrice( $youthCoefficient, $km, $minutes, $pricePerKM, $pricePerMinute, $gpsCost, $addDriver): int
    {
        return parent::calcRidePrice($youthCoefficient, $km, $minutes, $pricePerKM, $pricePerMinute, $gpsCost, $addDriver);
    }
}