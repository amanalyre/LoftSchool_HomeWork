<?php

namespace homework;

use PHPUnit\Framework\TestCase;

require('../../vendor/autoloader.php')

class Hw2Test extends TestCase
{

    function testTask1()
    {
        echo "Hi!";
        $array = ['Карл у Клары', 'Лара у Ары'];
        $result = task1($array, true);
        self::assertEquals('Карл у КларыЛара у Ары', $result);

    }

    function testTask4()
    {
        assertEquals(
                '2/6 = 0.33333333333333',
                task2_1('/', 2, 'dsfsdff', 6));
    }
}