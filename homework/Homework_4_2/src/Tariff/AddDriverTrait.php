<?php
/**
 * Created by PhpStorm.
 * User: mfgoreva
 * Date: 11.03.2019
 * Time: 4:59
 */

namespace Homework_4_2;


trait AddDriverTrait
{
    /**
     * @return int
     */
    public function addDriverCostCalc(): int
    {
        if ($this->isWithAddDriver) {
            $this->addDriver = 100;
        } else {
            $this->addDriver = 0;
        }

        return $this->addDriver;
    }
}