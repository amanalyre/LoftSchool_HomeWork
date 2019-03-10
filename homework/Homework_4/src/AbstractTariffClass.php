<?php

namespace Homework_4;

include "InterfaceTariff.php";

abstract class AbstractTariffClass implements InterfaceTariff
{

    protected $pricePerKM;
    protected $pricePerMinute;
    protected $driversAge;
    protected $youngDriverCoeff;

    function _construct($driversAge, $pricePerKM, $pricePerMinute, $withGPS = false, $youngDriverCoeff = 1)
    {
        $this->$driversAge = $driversAge;
        $this->$pricePerKM = $pricePerKM;
        $this->$pricePerMinute = $pricePerMinute;
        $this->$withGPS = $withGPS;

        if (!$this->isAcceptableAge($driversAge)) {
            die ('Driver\'s age isn\'t acceptable');
        }
        $this->$youngDriverCoeff = $this->isYoung($driversAge);
    }

    /**
     * Проверяет, проходит ли водитель по условию возраста
     * @param $driversAge
     * @return bool
     */
    function isAcceptableAge($driversAge)
    {
        if ($driversAge < 18 || $driversAge > 65) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Проверяет, нужно ли повышать коэффициент
     * @param $driverAge
     * @return float|int
     */
    function isYoung($driverAge)
    {
        if ($driverAge > 18 && $driverAge < 21) {
            return $youthCoefficient = 1.1; // TODO
        } else {
            return $youthCoefficient = 1;
        }
    }

    /**
     * Принимает человекочитаемое время (чч:мм:сс) и возвращает его для расчетов в секундах
     * @param string $time
     * @return int
     */
    public function calcRentTime(string $time) :int
    {
        //$time = "2:50"; example
        $hours = null;
        $minutes = null;
        $seconds = null;

        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);

        // Всегда округляем существующие секунды в бОльшую сторону, т.к. тарифы поминутные.
        if ($seconds > 0) {
            $seconds = 60;
        }

        $secondsSpent = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;

        return $secondsSpent;
    }

    public function calcRidePrice($youthCoefficient, $km, $minutes, $pricePerKM, $pricePerMinute, $gpsCost, $addDriver)  // сюда приходит стоимость допов, а не их наличие
    {
        $driveCost = null;

        $driveCost = (($km * $pricePerKM) + ($minutes * $pricePerMinute) + $gpsCost + $addDriver) * $youthCoefficient;

        return $driveCost;
    }
}