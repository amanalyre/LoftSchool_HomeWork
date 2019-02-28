<?php
//ТУТ ФИГНЯ ToDo поправить
require_once (__DIR__ . './functions/functions.php');
require_once(__DIR__ . './config/configure.php');
require_once(__DIR__ . './config/connection.php');


$sqlUsers = "SELECT id, us_name, us_email, us_phone, create_date FROM users LIMIT 100;";
$prepStmt = connection()->prepare($sqlUsers);
$prepStmt->execute();
$prepStmt->setFetchMode(PDO::FETCH_ASSOC);


$table = null;
$table .= "<table>";
foreach ($prepStmt->fetch() as $user => $data) {

    var_dump($data);
    $table .= "<tr>";
    foreach ($data as $key => $value) {
        $table .= "<td>$value</td>";
    }
    $table .= "</tr>";

}
$table .= "</table>";
return $table;


$sqlOrders = "SELECT o.id, street, description, u.us_mail
              FROM orders as o
              LEFT JOIN users as u 
              ON o.user_id = u.id;";
$prepStmt = connection()->prepare($sqlUsers);
$prepStmt->execute();
$prepStmt->setFetchMode(PDO::FETCH_ASSOC);


$table = null;
$table .= "<table>";
foreach ($prepStmt->fetch() as $order => $data) {

    var_dump($data);
    $table .= "<tr>";
    foreach ($data as $key => $value) {
        $table .= "<td>$value</td>";
    }
    $table .= "</tr>";

}
$table .= "</table>";
return $table;
