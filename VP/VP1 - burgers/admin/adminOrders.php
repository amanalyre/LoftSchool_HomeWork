<?php

require_once(__DIR__ . './../core/functions/functions.php');
require_once(__DIR__ . './../core/config/configure.php');
require_once(__DIR__ . './../core/config/connection.php');
require_once (__DIR__ . './../../../vendor/autoload.php');


$loader = new \Twig\Loader\FilesystemLoader('View');
$twig = new \Twig\Environment($loader);

$sqlOrders = "SELECT o.id, street, house, building, apartment, floor, description, u.us_email, u.us_name
              FROM orders as o
              LEFT JOIN users as u
              ON o.user_id = u.id;";
try {
    $prepStmt = connection()->prepare($sqlOrders);
    $prepStmt->execute();
} catch (PDOException $e) {
    $e->getMessage();
}
$orderData = $prepStmt->fetchAll(PDO::FETCH_ASSOC);

try {
    echo $twig->render('orderAdminView.twig', ['orderData' => $orderData]);
} catch (\Twig\Error\LoaderError $e) {
} catch (\Twig\Error\RuntimeError $e) {
} catch (\Twig\Error\SyntaxError $e) {
}