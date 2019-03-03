<?php

namespace Homework_4;


class TariffFactory
{
    public static function create($type)
    {
        $name = $type . 'Tariff';
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