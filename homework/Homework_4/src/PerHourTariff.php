<?php

namespace Homework_4;


class PerHourTariff extends AbstractTariffClass
{
    use WithGPSTrait;
    use AddDriverTrait;
    use RoundTimeTrait;

    protected $pricePerKM = 0;

    protected $pricePerMinute = 200 / 60; // 60m = 200r

//Цена за 1 км = 0
// Цена за 60 минут = 200 рублей
// Округление до 60 минут в большую сторону

}