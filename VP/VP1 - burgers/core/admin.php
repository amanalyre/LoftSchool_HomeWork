<?php
//ТУТ ФИГНЯ ToDo поправить
require_once(__DIR__ . './functions/functions.php');
require_once(__DIR__ . './config/configure.php');
require_once(__DIR__ . './config/connection.php');


$sqlUsers = "SELECT id, us_name, us_email, us_phone, create_date FROM users;";
$prepStmt = connection()->prepare($sqlUsers);
$prepStmt->execute();
$prepStmt->setFetchMode(PDO::FETCH_ASSOC);

echo '<b>' . 'Список зарегистрированных пользователей' . '</b>';
echo '</p>';
$table = null;
$table .= "<table>";
$table .= '<tr style="font-weight:bold; font-size: large">' .
        '<td style="border-bottom:2pt solid green;">ID</td>'
        . '<td style="border-bottom:2pt solid green;">Имя пользователя</td>'
        . '<td style="border-bottom:2pt solid green;">E-mail</td>'
        . '<td style="border-bottom:2pt solid green;">Телефон</td>'
        . '<td style="border-bottom:2pt solid green;">Дата регистрации</td>'
        . '</tr>';
while ($resDataUs = $prepStmt->fetchAll()) {
    foreach ($resDataUs as $user => $data) {

        $table .= "<tr>";
        foreach ($data as $key => $value) {
            $table .= "<td style=\"border-bottom:1pt solid black;\">$value</td>";
        }
        $table .= "</tr>";

    }
}
$table .= "</table>";
echo $table;

echo '</p>';

$sqlOrders = "SELECT o.id, street, house, building, apartment, floor, description, u.us_email, u.us_name
              FROM orders as o
              LEFT JOIN users as u 
              ON o.user_id = u.id;";
$prepStmt = connection()->prepare($sqlOrders);
$prepStmt->execute();
$prepStmt->setFetchMode(PDO::FETCH_ASSOC);


$table = null;
$table .= "<table>";

$table .= '<tr style="font-weight:bold; font-size: large">' .
        '<td style="border-bottom:2pt solid green;">ID</td>'
        . '<td style="border-bottom:2pt solid green;">Улица</td>'
        . '<td style="border-bottom:2pt solid green;">Дом</td>'
        . '<td style="border-bottom:2pt solid green;">Корпус</td>'
        . '<td style="border-bottom:2pt solid green;">Квартира</td>'
        . '<td style="border-bottom:2pt solid green;">Этаж</td>'
        . '<td style="border-bottom:2pt solid green;">Комментарий</td>'
        . '<td style="border-bottom:2pt solid green;">E-mail пользователя</td>'
        . '<td style="border-bottom:2pt solid green;">Имя пользователя</td>'

        . '</tr>';

echo '<b>' . 'Список совершенных заказов' . '</b>';
echo '</p>';
while ($resDataOrd = $prepStmt->fetchAll()) {
    foreach ($resDataOrd as $order => $data) {

        $table .= "<tr>";
        foreach ($data as $key => $value) {
            $table .= "<td style=\"border-bottom:1pt solid black;\">$value</td>";
        }
        $table .= "</tr>";

    }
}
$table .= "</table>";
echo $table;
