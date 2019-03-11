<?php

namespace Homework_4_2;

require_once 'WithGPSTrait.php';

class BaseTariff extends AbstractTariff
{
    use WithGPSTrait;

    protected $pricePerKM = 10;
    protected $pricePerMinute = 3;
    protected $km;
    protected $timeSpent; // raw time
    protected $driversAge; // возраст водителя
    protected $youngDriverCoeff; // надо ли домножать на 10%
    protected $isWithGPS; // был ли использован GPS bool
    protected $gpsCost;
    protected $isWithAddDriver;
    protected $addDriver; // стоимость доп. водителя для расчета

    /**
     * BaseTariff constructor.
     * @param $km
     * @param $timeSpent
     * @param $driversAge
     * @param bool $isWithGPS
     * @param bool $isWithAddDriver
     */
    public function __construct($km, $timeSpent, $driversAge, $isWithGPS = false, $isWithAddDriver = false)
    {
        $this->driversAge = $driversAge;
        parent::__construct($this->driversAge, $withGPS = false, $this->youngDriverCoeff);
        $this->km = $km;
        $this->timeSpent = $timeSpent;
        $this->isWithGPS = $isWithGPS;
        $this->isWithAddDriver = $isWithAddDriver;
    }

    /**
     * @return float|int
     */
    public function calcRentCost()
    {
        $minutesSpent = self::calcRentTime($this->timeSpent);
        $this->gpsCost = $this->calculateGPSCost($minutesSpent);
        $rentCost = (($this->pricePerKM * $this->km) + ($this->pricePerMinute * $minutesSpent)) * $this->youngDriverCoeff
                + $this->gpsCost;

        return $rentCost;
    }
}