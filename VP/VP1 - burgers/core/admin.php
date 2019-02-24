<?php

require_once (__DIR__ . './functions/functions.php');
require_once(__DIR__ . './config/configure.php');
require_once(__DIR__ . './config/connection.php');


$sqlUsers = "SELECT * FROM users;";
$prepStmt = connection()->prepare($sqlUsers);
$prepStmt->bindParam(':email', $email);
$prepStmt->execute();
$prepStmt->setFetchMode(PDO::FETCH_ASSOC);
//$prepStmt->fetch();

var_dump($prepStmt);
echo '<pre>';
echo json_encode($prepStmt);