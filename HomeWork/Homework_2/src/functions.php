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
    $clearArgs = [];

    if (in_array($sign, ['+', '-', '*', '/', '**', '%'])) {
        foreach ($args as $arg) {
            if (is_float($arg) || is_int($arg)) {
                array_push($clearArgs, $arg);
            }
        }
    } else {
        return 'Введенный знак не является арифметическим действием';
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
            for ($p = $clearArgs[0], $i = 1, $n = $clearArgs[1]; // выполняется 1 раз
                 $i <= count($clearArgs) - 1; // если false - выходим
                 $n = $clearArgs[$i++]) { // вычисляется в конце каждой итерации
                $p = $p / $n;
            };
            $expResult = $p;
            break;
        case "%":
            break;
        case "**":
            break;

    }
    return $expResult;
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

    $file = 'test.txt';
    $write = file_put_contents($file, $text);
    if ($write) {
        true;
    } else {
        echo 'Ошибка при записи в файл.';
    }

    return $file;
}

function task6_2()
{
    $fileToRead = task6();
    $data = file_get_contents($fileToRead);

    echo $data;
    return true;
}