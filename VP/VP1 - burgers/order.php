<?php


require_once (__DIR__ . './core/functions/functions.php');
require_once(__DIR__ . './core/config/configure.php');
require_once(__DIR__ . './core/config/connection.php');

if ($_POST) {
    $data = $_POST['data'];
}

$clearData = checkData($data);

$order = orderBurgers($clearData);

if ($order) {
    echo "Ваш заказ успешно создан";
}