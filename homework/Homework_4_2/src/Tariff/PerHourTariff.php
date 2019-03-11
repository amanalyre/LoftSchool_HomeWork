<?php

namespace Homework_4_2;

require_once 'WithGPSTrait.php';
require_once 'AddDriverTrait.php';

class PerHourTariff extends AbstractTariff
{

    use WithGPSTrait;
    use AddDriverTrait;

    protected $pricePerKM = 0;
    protected $pricePerMinute = 200 / 60;
    protected $km;
    protected $timeSpent; // raw time
    protected $driversAge; // возраст водителя
    protected $youngDriverCoeff; // надо ли домножать на 10%
    protected $isWithGPS; // был ли использован GPS bool
    protected $gpsCost;
    protected $isWithAddDriver;
    protected $addDriver; // стоимость доп. водителя для расчета

    public function __construct($km, $timeSpent, $driversAge, $isWithGPS = false, $isWithAddDriver = false)
    {
        $this->driversAge = $driversAge;
        parent::__construct($this->driversAge, $withGPS = false, $this->youngDriverCoeff);
        $this->km = $km;
        $this->timeSpent = $timeSpent;
        $this->isWithGPS = $isWithGPS;
        $this->isWithAddDriver = $isWithAddDriver;
    }

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
        if ($minutes > 0) {
            $minutes = 60;
        }
        $secondsSpent = isset($hours) ? ($hours * 3600 + $minutes * 60 + $seconds) : ($minutes * 60 + $seconds);// считает, что 00:00 - это часы
        $this->minutesSpent = $secondsSpent / 60;
        return $this->minutesSpent;
    }

    /**
     * @return float|int
     */
    public function calcRentCost()
    {
        $minutesSpent = self::calcRentTime($this->timeSpent);
        $this->gpsCost = $this->calculateGPSCost($minutesSpent);
        $this->addDriver = $this->addDriverCostCalc();
        $rentCost = (($this->pricePerKM * $this->km) + ($this->pricePerMinute * $minutesSpent)) * $this->youngDriverCoeff
                + $this->gpsCost
                + $this->addDriver;

        return $rentCost;
    }
}