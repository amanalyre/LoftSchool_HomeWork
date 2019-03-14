<?php

namespace Homework_4_2;

use Homework_4\TariffFactory;

require_once 'src/Tariff/AbstractTariff.php';
require_once 'src/Tariff/BaseTariff.php';
require_once 'src/Tariff/StudentTariff.php';
require_once 'src/Tariff/PerHourTariff.php';
require_once 'src/Tariff/PerDayTariff.php';
require_once 'src/Tariff/TariffFactory.php';

echo '<pre>';
echo '<h1>Добро пожаловать в нашу каршеринговую компанию!</h1></p>';
echo 'Ниже описаны наши тарифы и приведены примеры расчета цены поездки: </p>';

////////////////////////
echo '<h2>Тариф <b>Базовый</b></h2></p>';
echo '10р/км, 3р/минута. Например, поездка на 23 км за 3 часа 3 минуты обойдётся вам в <b>';
$base = new BaseTariff(23, '03:03', 20);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

echo 'Эта же поездка, но с GPS обойдётся вам в <b>';
$base = new BaseTariff(23, '03:03', 20, true);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

////////////////////////
echo '<h2>Тариф <b>Студенческий</b></h2></p>';
echo '4р/км, 1р/минута. Например, поездка на 23 км за 3 часа 3 минуты обойдётся вам в <b>';
$base = new StudentTariff(23, '03:03', 20);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

echo 'Эта же поездка, но с GPS обойдётся вам в <b>';
$base = new StudentTariff(23, '03:03', 20, true);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

////////////////////////
echo '<h2>Тариф <b>Почасовой</b></h2></p>';
echo '0р/км, 200р/час. Например, поездка на 23 км за 3 часа 3 минуты обойдётся вам в <b>';
$base = new PerHourTariff(23, '03:03', 20);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

echo 'Эта же поездка, но с GPS обойдётся вам в <b>';
$base = new PerHourTariff(23, '03:03', 20, true);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

echo 'Эта же поездка, но с GPS и еще одним водителем обойдётся вам в <b>';
$base = new PerHourTariff(23, '03:03', 20, true, true);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

////////////////////////
echo '<h2>Тариф <b>Суточный</b></h2></p>';
echo '1р/км, 1000р/сутки, до 30 минут сверх суток не учитываем. Например, поездка на 23 км за 3 часа 3 минуты обойдётся вам в <b>';
$base = new PerDayTariff(23, '03:03', 20);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

echo 'Эта же поездка, но с GPS обойдётся вам в <b>';
$base = new PerDayTariff(23, '03:03', 20, true);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

echo 'Поездка, длиной 48 часов 31 минуту на 200 км с GPS и еще одним водителем обойдётся вам в <b>';
$base = new PerDayTariff(200, '48:31', 20, true, true);
echo $base->calcRentCost();
echo '</b> рублей. </p>';

try {
    TariffFactory::create('Base')->calcRidePrice();
} catch (\Exception $e)  {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}