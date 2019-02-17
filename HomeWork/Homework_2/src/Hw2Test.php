<?php

namespace homework;

use PHPUnit\Framework\TestCase;

require('functions.php');

class Hw2Test extends TestCase
{

    /**
     * Unit tests for task1()
     */
    function testTask1_1()
    {
        $array = ['Карл у Клары', 'Лара у Ары'];
        $result = task1($array, true);
        self::assertEquals('Карл у КларыЛара у Ары', $result, 'Одинаковы');

    }

    function testTask1_2()
    {
        $array = ['Карл у Клары', 'Лара у Ары'];
        $result = task1($array);
        self::assertEquals('Карл у Клары <p>Лара у Ары <p>', $result, 'Одинаковы');

    }

    /**
     * Unit tests for task2()
     */
    function testTask2_1_1()
    {
        $result = task2_1('+', 22222, 12345, 9999999, '\+3*#$');
        self::assertEquals(
                '22222+12345+9999999 = 10034566',
                $result,
                "Сравнение с $result"
        );
    }

    function testTask2_1_2()
    {
        $result = task2_1('/', 2, 'dsfsdff', 6);
        self::assertEquals(
                '2/6 = 0.33333333333333',
                $result
        );
    }

    function testTask2_2_1()
    {
        $result = task2_2('+', 2, 'dsfsdff', 6);
        self::assertEquals(
                '8',
                $result, "Получили $result"
        );
    }

    function testTask2_2_4()
    {
        $result = task2_2('/', 2, 'dsfsdff', 6);
        self::assertEquals(
                '0.33333333333333',
                $result, "Получили $result"
        );
    }
}