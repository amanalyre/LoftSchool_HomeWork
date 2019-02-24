<?php

require_once(__DIR__ . './../config/configure.php');

/**
 * Получаем настройки для коннекта к базе
 * @return mixed|null
 */
function getConfig()
{
    static $config = null;
    if ($config === null) {
        $config = require (__DIR__ . './../config/connection.php');
    }
    return ($config);
}

function connection()
{
    try {
        $config = getConfig();
        $db = new PDO(
                "mysql:host=$config[db_host];dbname=$config[db_database]",
                $config['db_user'],
                $config['db_password']);
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die("Couldn't establish connection");
    }
}

function checkData(array &$data) // Обратить внимание, тут могут быть неожиданности из-за &-ссылки
{
    foreach ($data as $param) {
        $param = trim($param);
        htmlspecialchars($param);
    }

    return $data;
}

function addNewUser($data)
{
    $sqlUser = "INSERT INTO users (us_name, us_email, us_phone) VALUES (:name, :email, :phone);";
    $pdo = connection();
    $prepStmt = $pdo->prepare($sqlUser);
    $prepStmt->bindParam(':email', $data['email']);
    $prepStmt->bindParam(':name', $data['name']);
    $prepStmt->bindParam(':phone', $data['phone']);
    $prepStmt->execute();

    return $pdo->lastInsertId();
}

function getUser($email)
{
    $qSelect = "SELECT us_name, us_email, us_phone, id FROM users WHERE us_email = :email;";
    $prepStmt = connection()->prepare($qSelect);
    $prepStmt->bindParam(':email', $email);
    $prepStmt->execute();
    $prepStmt->setFetchMode(PDO::FETCH_ASSOC);
    return $prepStmt->fetch();
}

function registration($data) //ожидает на вход типа $data
{
    $user = getUser($data['email']);
    if ($user) {
        var_dump($user);
        return $user['id'];
    } else {
        $user = addNewUser($data);
        var_dump($user);
        return $user;
    }

}


function orderBurgers($data)
{
    $userId = registration($data);
    $sqlOrder = "INSERT INTO 
              orders (create_date, street, house, building, apartment, floor, description, payment_type, callback, user_id)
              VALUES(NOW(), :street, :house, :building, :apartment, :floor, :description, :payment_type, :callback, $userId);";
    $pdo = connection();
    $stmt = $pdo->prepare($sqlOrder);
    $stmt->bindParam(':street', $data['street']);
    $stmt->bindParam(':home', $data['house']);
    $stmt->bindParam(':part', $data['building']);
    $stmt->bindParam(':appt', $data['apartment']);
    $stmt->bindParam(':floor', $data['floor']);
    $stmt->bindParam(':comment', $data['description']);
    $stmt->bindParam(':payment', $data['payment_type']);
    $stmt->execute();
    $orderId = $pdo->lastInsertId();
    sendResponse($orderId, $data, $userId);

    return true;


}

function sendResponse($id, $data, $userId)
{
    $fileName = "(mail)Order-" . $id . ".txt";
    $content = "Заказ # $id" . PHP_EOL .
            "Ваш заказ будет доставлен по адресу:" . PHP_EOL .
            "улица " . $data['street'] . ", " .
            "дом " . $data['house'] . ", " .
            "корпус " . $data['building'] . ", " .
            "квартира " . $data['apartment'] . ", " .
            "этаж " . $data['floor'] . "." . PHP_EOL .
            "Состав заказа: Бургер DarkBeefBurger, 1шт, цена 500р," . PHP_EOL . PHP_EOL;
    $orderNumber = "SELECT COUNT(*) as 'count' FROM orders WHERE user_id = $userId;";
    $pdo = connection();
    $stmt = $pdo->prepare($orderNumber)
                ->execute();
    $pdo->setFetchMode(PDO::FETCH_ASSOC); // ToDo WTF?
    $arr = $stmt->fetch();
    if ($arr["count"] === '1') {
        $content = $content . "Спасибо - это ваш первый заказ";
    } else {
        $content = $content . "Спасибо! Это уже " . $arr["count"] . " заказ.";
    }
    file_put_contents($fileName, $content);
}


//function sendAjax()
//{
//    var userId = $('#user_id').val();
//    $.get('pdo.php'), (id:userId, ajax: 1), function(resp) {
//        console.log('resp', resp);
//        var data = JSON.parse(resp);
//        console.log('data', data);
//    }
//}

