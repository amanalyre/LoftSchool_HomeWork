<?php

namespace Homework_4_2;


abstract class AbstractTariff
{
    protected $pricePerKM;
    protected $pricePerMinute;
    protected $timeFromDriver;
    protected $km;
    protected $timeSpent; //входящее время аренды
    protected $minutesSpent; //пересчитанное время аренды
    protected $driversAge;
    protected $youngDriverCoeff;


    function __construct($driversAge, $pricePerKM, $pricePerMinute, $withGPS = false, $youngDriverCoeff = 1)
    {
        $this->$driversAge = $driversAge;
        $this->$pricePerKM = $pricePerKM;
        $this->$pricePerMinute = $pricePerMinute;
        $this->$withGPS = $withGPS;
        if (!$this->isAcceptableAge($driversAge)) {
            die ('Driver\'s age isn\'t acceptable');
        }
        $this->youngDriverCoeff = $this->isYoungCoefficient($driversAge);
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
    function isYoungCoefficient($driverAge)
    {
        if ($driverAge > 18 && $driverAge < 21) {
            return $youthCoefficient = 1.1;
        } else {
            return $youthCoefficient = 1;
        }
    }

    /**
     * Принимает человекочитаемое время (чч:мм:сс) и возвращает его для расчетов в минутах
     * @param string $time
     * @return int Количество минут
     */
    protected function calcRentTime(string $time) :int
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
        $secondsSpent = isset($hours) ? ($hours * 3600 + $minutes * 60 + $seconds) : ($minutes * 60 + $seconds);// считает, что 00:00 - это часы
        $this->minutesSpent = $secondsSpent / 60;
        return $this->minutesSpent;
    }

    abstract function calcRentCost();

}