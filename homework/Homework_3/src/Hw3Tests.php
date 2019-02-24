<?php

use PHPUnit\Framework\TestCase;

require('functions.php');

class Hw3Tests extends TestCase
{

    /**
     * Unit tests for task1(): Table is not empty
     */
    function testTask1_NotEmpty()
    {

        $result = task1();
        self::assertNotEmpty($result, "Таблица пуста");

    }

    /**
     * Unit tests for task2(): Table is not empty
     */
    function testTask2_NotEmpty()
    {

        $result = task2();
        self::assertNotNull($result, "Сумма пуста: $result");

    }

    /**
     * Unit tests for task2(): Table is not empty
     */
    function testTask3_NotEmpty()
    {

        $result = task3();
        self::assertNotNull($result, "Сумма пуста: $result");

    }
}