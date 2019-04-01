<?php

require_once(__DIR__ . './../core/functions/functions.php');
require_once(__DIR__ . './../core/config/configure.php');
require_once(__DIR__ . './../core/config/connection.php');
require_once (__DIR__ . './../../../vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('View');
$twig = new \Twig\Environment($loader);

$sqlUsers = "SELECT id, us_name, us_email, us_phone, create_date FROM users;";
try {
    $prepStmt = connection()->prepare($sqlUsers);
    $prepStmt->execute();
} catch (PDOException $e) {
    $e->getMessage();
}
$usersData = $prepStmt->fetchAll(PDO::FETCH_ASSOC);

try {
    echo $twig->render('userAdminView.twig', ['usersData' => $usersData]);
} catch (\Twig\Error\LoaderError $e) {
} catch (\Twig\Error\RuntimeError $e) {
} catch (\Twig\Error\SyntaxError $e) {
}