<?php
//ТУТ ФИГНЯ ToDo поправить
require_once(__DIR__ . './../core/functions/functions.php');
require_once(__DIR__ . './../core/config/configure.php');
require_once(__DIR__ . './../core/config/connection.php');

$loader = new \Twig\Loader\FilesystemLoader('view');
$twig = new \Twig\Environment($loader);


echo $twig->render('adminView.twig');