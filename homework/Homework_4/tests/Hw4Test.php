<?php

namespace homework\Homework_2;

use PHPUnit\Framework\TestCase;
use Homework_4\AbstractTariffClass;


class Hw4Test extends TestCase
{
    public function calcGPSCostTest()
    {
        //
    }

    public function calcRentTimeTest()
    {
        $time = '2:50';
        $result = calcRentTime($time);
        self::assertEquals('', $result, 'Одинаковы');
    }
}