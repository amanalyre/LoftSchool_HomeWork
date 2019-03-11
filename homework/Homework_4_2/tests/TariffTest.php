<?php

namespace Homework_4_2;

use PHPUnit\Framework\TestCase;

require './../src/Tariff/BaseTariff.php';
require './../src/Tariff/AbstractTariff.php';


class TariffTest extends TestCase
{

    /**
     * Unit tests for task1()
     */
    function testRentHours()
    {
        $base = new BaseTariff(23, '10:10:10', 23);
        $result = $base->calcRentCost();
        self::assertEquals(2063, $result, 'Одинаковы');

    }
}