<?php

/**
 * @param array $strings
 * @param bool $isUnited
 * @return null|string
 */
function task1(array $strings, $isUnited = false)
{
    $text = null;
    if ($isUnited) {
        $text = implode($strings);
    } else {
        foreach ($strings as $string) {
            $text .= "$string <p>";
        }
    }

    return $text;
}

function testTask1()
{
    echo "Hi!";
    $array = ['Карл у Клары', 'Лара у Ары'];
    $result = task1($array, true);
    self::assertEquals('Карл у КларыЛара у Ары', $result);

}

/**
 * Принимает на вход знак и набор параметров, составляет и вычисляет выражение
 * TODO не проверяет деление на 0
 * @param $sign
 * @param mixed ...$args
 * @return string
 */
function task2_1($sign, ...$args)
{
    $result = null;
    $clearArgs = [];

    if (in_array($sign, ['+', '-', '*', '/', '**', '%'])) {
        foreach ($args as $arg) {
            if (is_float($arg) || is_int($arg)) {
                array_push($clearArgs, $arg);
            }
        }
        $result = implode($sign, $clearArgs);
    } else {
        return 'Вы ввели неправильный знак';
    }

    return $result . ' = ' . eval("return $result;");
}

function task2_2($sign, ...$args)
{
    $result = null;
    $clearArgs = [];

    if (in_array($sign, ['+', '-', '*', '/', '**', '%'])) {
        foreach ($args as $arg) {
            if (is_float($arg) || is_int($arg)) {
                array_push($clearArgs, $arg);
            }
        }
    } else {
        return 'Вы ввели неправильный знак';
    }

    $expResult = null;
    switch ($sign) {
        case "+":
            $expResult = array_sum($clearArgs);
            break;
        case "-":
            $expResult = $args[0] * 2 - array_sum($clearArgs);
            break;
        case "*":
            $expResult = array_product($clearArgs);
            break;
        case "/":
//            foreach ($clearArgs as $arg) {
//                if
//            }
            break;
        case "%":
            break;
        case "**":
            break;

    }
    return "$result = $expResult";
}


function testTask4()
{
    assertEquals(
            '2/6 = 0.33333333333333',
            task2_1('/', 2, 'dsfsdff', 6));
}

/**
 * @param int $r количество строк, tr
 * @param int $c количество столбцов, td
 * @return string
 */
function task3(int $r, int $c)
{
    if (is_int($r) && is_int($c)) {
        $rows = $r; // количество строк, tr
        $cols = $c; // количество столбцов, td

        $table = '<table border="2">';

        for ($tr = 1; $tr <= $rows; $tr++) {
            $table .= '<tr>';
            for ($td = 1; $td <= $cols; $td++) {
                if ($tr % 2 === 0 && $td % 2 === 0) {
                    $table .= '<td bgcolor="aqua"> (' . $tr * $td . ') </td>';
                } elseif ($tr % 2 != 0 && $td % 2 != 0) {
                    $table .= '<td bgcolor="#faebd7"> [' . $tr * $td . '] </td>';
                } else {
                    $table .= '<td>' . $tr * $td . '</td>';
                }
            }
            $table .= '</tr>';
        }

        $table .= '</table>';
        return $table;
    } else {
        return "Переданные $r и $c не являются целыми числами. Пожалуйста, попробуйте еще раз.";
    }
}

/**
 * Возвращает текущую дату и заданную дату
 */
function task4()
{
    echo date('d.m.Y H:i');
    echo '<p>';
    echo strtotime('24.02.2016 00:00:00');

    return true;
}

/**
 * Заменяем/удаляем части из текстов
 */
function task5()
{
    echo str_replace('К', '', 'Карл у Клары украл Кораллы');
    echo '<p>';
    echo str_replace('Две', 'Три', 'Две бутылки лимонада');

    return true;
}

function task6()
{
    $text = 'Hello again!';

    $file = fopen("test.txt", 'w');
    $write = fwrite($file, $text);
    if ($write) {
        echo 'Данные в файл успешно занесены.';
    } else {
        echo 'Ошибка при записи в файл.';
    }
    fclose($file);
    return true;
}

function task6_2($fileToRead)
{
    fopen($fileToRead, 'rt');

    echo readfile($fileToRead);

    fclose($fileToRead);
}