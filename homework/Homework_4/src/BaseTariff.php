<?php

namespace Homework_4;


class BaseTariff extends AbstractTariffClass
{
    use WithGPSTrait;

    protected $pricePerKM = 10;

    protected $pricePerMinute = 3;
}