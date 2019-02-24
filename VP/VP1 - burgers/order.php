<?php


require_once (__DIR__ . './core/functions/functions.php');
require_once(__DIR__ . './core/config/configure.php');
require_once(__DIR__ . './core/config/connection.php');

if ($_POST) {
    $data = $_POST['data'];
}


$order = orderBurgers($data);