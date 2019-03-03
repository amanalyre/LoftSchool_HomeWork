<?php

require_once 'src/AbstractTariffClass.php';
require_once 'src/InterfaceTariff.php';
require_once 'src/AddDriverTrait.php';
require_once 'src/WithGPSTrait.php';
require_once 'src/BaseTariff.php';
require_once 'src/PerDayTariff.php';
require_once 'src/PerHourTariff.php';
require_once 'src/StudentTariff.php';

try {
    \Homework_4\TariffFactory::create('Base');
} catch (Exception $e)  {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}