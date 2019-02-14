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

function task2_1($sign,  ...$args)
{
    $result = $args[0];
    $numberOfArgs = count($args);
    $count = 1;

    while ($count <= $numberOfArgs) {
        foreach ($args as $arg) {
            if (is_float($arg) || is_int($arg)) { //Если число (но приводит строку к числу)
                $result .= "$sign $arg";
            }
            $count++;
        }
    }

    $result = preg_replace('/\s+/', '', $result);

    $number = '(?:\d+(?:[,.]\d+)?|pi|π)';
    $operators = '[+\/*\^%-]';
    $regexp = '/^(('.$number.'|'.'\s*\((?1)+\)|\((?1)+\))(?:'.$operators.'(?2))?)+$/';

    var_dump($result);
    $finalResult = null;
    if (preg_match($regexp, $result))
    {
        $finalResult = eval('$result = '.$result.';');
    }
    else
    {
        $result = false;
    }
var_dump($result);
    return $result .+ $finalResult;
}

function task2_2($sign,  ...$args)
{
    $result = $args[0];
    $numberOfArgs = count($args);
    $count = 1;

    while ($count <= $numberOfArgs) {
        foreach ($args as $arg) {
            if (is_float($arg) || is_int($arg)) { //Если число (но приводит строку к числу)
                $result .= "$sign $arg";
            }
            $count++;
        }
    }

    switch($sign) {
        case "+":
            $result = array_sum($args);
            break;
        case "-":
            $result = $args[0]*2 - array_sum($args);
            break;
        case "*":
            $result = array_product($args);
            break;
        case "/":
            break;
        case "%":
            break;
        case "**":
            break;

    }
    return $result;
}

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