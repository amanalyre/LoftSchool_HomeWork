<?php

use PHPUnit\Framework\TestCase;

require('functions.php');

class Hw3Tests extends TestCase
{

    /**
     * Unit tests for task1()
     */
    function testTask1_1()
    {

        $result = task1($array, true);
        self::assertEquals('Карл у КларыЛара у Ары', $result, 'Одинаковы');

    }
}