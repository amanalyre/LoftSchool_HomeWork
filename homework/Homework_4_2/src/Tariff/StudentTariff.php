<?php

namespace Homework_4_2;

require_once 'WithGPSTrait.php';

class StudentTariff extends AbstractTariff
{

    use WithGPSTrait;

    protected $pricePerKM = 4;
    protected $pricePerMinute = 1;
    protected $km;
    protected $timeSpent; // raw time
    protected $driversAge; // возраст водителя
    protected $youngDriverCoeff; // надо ли домножать на 10%
    protected $isWithGPS; // был ли использован GPS bool
    protected $gpsCost;

    /**
     * StudentTariff constructor.
     * @param $km
     * @param $timeSpent
     * @param $driversAge
     * @param bool $isWithGPS
     */
    public function __construct($km, $timeSpent, $driversAge, $isWithGPS = false)
    {
        $this->driversAge = $driversAge;
        parent::__construct($this->driversAge, $withGPS = false, $this->youngDriverCoeff);
        $this->km = $km;
        $this->timeSpent = $timeSpent;
        $this->isWithGPS = $isWithGPS;
        if (!$this->isAcceptableAge($driversAge)) {
            die ('Driver\'s age isn\'t acceptable');
        }
    }

    /**
     * Проверяет, проходит ли водитель по условию возраста
     * @param $driversAge
     * @return bool
     */
    function isAcceptableAge($driversAge)
    {
        if ($driversAge < 18 || $driversAge > 25) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Подсчитывает стоимость аренды с указанными условиями
     * @return float|int
     */
    public function calcRentCost()
    {
        $minutesSpent = self::calcRentTime($this->timeSpent);
        $this->gpsCost = $this->calculateGPSCost($minutesSpent);
        $rentCost = (($this->pricePerKM * $this->km) +
                        ($this->pricePerMinute * $minutesSpent)) *
                    $this->youngDriverCoeff +
                    $this->gpsCost;

        return $rentCost;
    }

}