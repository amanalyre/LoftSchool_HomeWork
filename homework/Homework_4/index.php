<?php
namespace Homework_4;

require_once 'src/AbstractTariffClass.php';
require_once 'src/InterfaceTariff.php';
require_once 'src/TariffFactory.php';
require_once 'src/AddDriverTrait.php';
require_once 'src/WithGPSTrait.php';
require_once 'src/RoundTimeTrait.php';
require_once 'src/BaseTariff.php';
require_once 'src/PerDayTariff.php';
require_once 'src/PerHourTariff.php';
require_once 'src/StudentTariff.php';


$tar = new BaseTariff();

try {
    TariffFactory::create('Base')->calcRidePrice();
} catch (\Exception $e)  {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
