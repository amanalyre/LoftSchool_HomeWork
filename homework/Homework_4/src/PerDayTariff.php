<?php

namespace Homework_4;


class PerDayTariff extends AbstractTariffClass
{
//цена за 1 км = 1 рубль
// цена за 24 часа = 1000 рублей
// округление до 24 часов в большую сторону, но не менее 30 минут. Например 24
//часа 29 минут = 1 сутки. 23 часа 59 минут = 1 сутки. 24 часа 31 минута = 2 суток.
    use withGPSTrait;
    use AddDriverTrait;

    protected $pricePerKM = 1;

    protected $pricePerMinute = 1000 / (24 * 60);
}