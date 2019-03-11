<?php

namespace Homework_4_2;

require_once 'WithGPSTrait.php';
require_once 'AddDriverTrait.php';

class PerDayTariff extends AbstractTariff
{

    use WithGPSTrait;
    use AddDriverTrait;

    protected $pricePerKM = 1;
    protected $pricePerMinute = 1000; // здесь на самом деле тариф за сутки, а не минуту
    protected $km;
    protected $timeSpent; // raw time
    protected $driversAge; // возраст водителя
    protected $youngDriverCoeff; // надо ли домножать на 10%
    protected $isWithGPS; // был ли использован GPS bool
    protected $gpsCost;
    protected $isWithAddDriver;
    protected $addDriver; // стоимость доп. водителя для расчета
    private $daysSpent;

    public function __construct($km, $timeSpent, $driversAge, $isWithGPS = false, $isWithAddDriver = false)
    {
        $this->driversAge = $driversAge;
        parent::__construct($this->driversAge, $withGPS = false, $this->youngDriverCoeff);
        $this->km = $km;
        $this->timeSpent = $timeSpent;
        $this->isWithGPS = $isWithGPS;
        $this->isWithAddDriver = $isWithAddDriver;
    }

    protected function calcRentTime(string $time): int
    {
        //$time = "2:50"; example
        $hours = null;
        $minutes = null;
        $seconds = null;
        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
        $secondsSpent = isset($hours) ? ($hours * 3600 + $minutes * 60 + $seconds) : ($minutes * 60 + $seconds);// считает, что 00:00 - это часы
        $this->minutesSpent = $secondsSpent / 60;

        return $this->minutesSpent;
    }

    private function calcRentDays() //сначала нужно делить на нормальное число в дне, а остаток сравнивать
    {
        $maxDayTime = 1440; // 24 часа * 60 минут

        if ($this->minutesSpent <= $maxDayTime) {
            $this->daysSpent = ceil($this->minutesSpent / $maxDayTime);
        } else {
            $this->daysSpent = intval($this->minutesSpent / $maxDayTime);
            ($this->minutesSpent % $maxDayTime) > 30 ? ++$this->daysSpent : $this->daysSpent;
        }
        return $this->daysSpent;
    }

    public function calcRentCost() // хрень в минутах
    {
        $minutesSpent = self::calcRentTime($this->timeSpent);
        $daySpent = self::calcRentDays();
        $this->gpsCost = $this->calculateGPSCost($minutesSpent);
        $this->addDriver = $this->addDriverCostCalc();
        $rentCost = (($this->pricePerKM * $this->km) + ($this->pricePerMinute * $daySpent)) * $this->youngDriverCoeff
                + $this->gpsCost
                + $this->addDriver;

        return $rentCost;
    }
}