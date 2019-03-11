<?php

namespace Homework_4;

use Homework_4_2\InterfaceTariff;

require_once 'AbstractTariff.php';
require_once 'InterfaceTariff.php';
require_once 'AddDriverTrait.php';
require_once 'WithGPSTrait.php';
require_once 'BaseTariff.php';
require_once 'PerDayTariff.php';
require_once 'PerHourTariff.php';
require_once 'StudentTariff.php';

class TariffFactory
{
    public static function create($type)
    {
        $name = $type . 'Tariff';
        $path = $_SERVER['DOCUMENT_ROOT'] . '/homework/Homework_4/src/' . $name;
        require $path;
        if (!class_exists($name)) {
            throw new \Exception('Class doesn\'t exist');
        } else {
            $class = new $name;
            if ($class instanceof InterfaceTariff) {
                return $class;
            } else {
                throw new \Exception('Class doesn\'t implement Interface');
            }
        }
    }
}