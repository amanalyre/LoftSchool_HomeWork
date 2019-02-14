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
            return array_sum($args);
            break;
        case "-":
            return $args[0]*2 - array_sum($args);
            break;
        case "*":
            return array_product($args);
            break;
        case "/":
            break;
        case "%":
            break;
        case "**":
            break;

    }
}