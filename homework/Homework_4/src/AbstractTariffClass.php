<?php

namespace Homework_4;


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
            return $coeff = 1.1; // TODO
        } else {
            return $coeff = 1;
        }
    }

    function calcRentTime()
    {

    }

    function roundRentTime()
    {
        // 1. No round
        // 2.
    }

    public function calcRidePrice($driverAge, $km, $minutes, $pricePerKM, $pricePerMinute, $withGPS = false, $addDriver = false)
    {

    }
}