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

/**
 * Получаем соединение
 * @return PDO
 */
function connection() :\PDO
{
    try {
        $config = getConfig();
        $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $db = new PDO(
                "mysql:host={$config['db_host']};dbname={$config['db_database']};{charset=$config[charset]}",
                $config['db_user'],
                $config['db_password'],
                $opt);
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die("Couldn't establish connection");
    }
}

function formRequiredFields(array $data)
{
    if (!$data['callback']) { //Notice: Undefined index: callback
        $data['callback'] = 0;
    }
    $expectedValues = ['name', 'phone', 'email', 'street', 'house', 'building', 'apartment', 'floor', 'description'];
    $errors = [];
var_dump($data);
    foreach ($expectedValues as $field) {
        if (empty($data[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if (!count($errors)) {
        return $result = [
                'result' => true,
                'data' => $data];
    } else {
        return $result = [
                'result' => false,
                'errors' => $errors];
    }
}

/**
 * Проверяем входящие данные на безопасность
 * @param array $data
 * @return array
 */
function checkData(array &$data) // Обратить внимание, тут могут быть неожиданности из-за &-ссылки
{
    foreach ($data as $param) {
        $param = trim($param);
        htmlspecialchars($param);
    }

    return $data;
}

/**
 * Добавляем нового юзера
 * @param $data
 * @return string
 */
function addNewUser($data)
{
    $cr_date = date('Y-m-d G:i:s');

    $sqlUser = "INSERT INTO 
            users (create_date, us_name, us_email, us_phone) 
            VALUES (:create_date, :name, :email, :phone);";
    $pdo = connection();
    $prepStmt = $pdo->prepare($sqlUser);
    $prepStmt->bindParam(':create_date', $cr_date);
    $prepStmt->bindParam(':email', $data['email']);
    $prepStmt->bindParam(':name', $data['name']);
    $prepStmt->bindParam(':phone', $data['phone']);
    $prepStmt->execute();

    return $pdo->lastInsertId();
}

/**
 * Ищем существующего юзера по почте
 * @param $email
 * @return mixed
 */
function getUser($email)
{
    $qSelect = "SELECT us_name, us_email, us_phone, id FROM users WHERE us_email = :email;";
    $prepStmt = connection()->prepare($qSelect);
    $prepStmt->bindParam(':email', $email);
    $prepStmt->execute();
    $prepStmt->setFetchMode(PDO::FETCH_ASSOC);
    return $prepStmt->fetch();
}

/**
 * Проверяем, существует ли юзер. Если нет - регистрируем. Возвращает user_id
 * @param $data
 * @return mixed|string
 */
function registration($data) //ожидает на вход типа $data
{
    $user = getUser($data['email']);
    if ($user) {
        return $user['id'];
    } else {
        $user = addNewUser($data);
        return $user;
    }

}

/**
 * Создаем заказ. Дергает проверку существования юзера и "отправку" письма.
 * @param $data
 * @return bool
 */
function orderBurgers($data)
{
    $userId = registration($data);
    $cr_date = date('Y-m-d G:i:s');

    $sqlOrder = "INSERT INTO 
              orders (create_date, street, house, building, apartment, floor, description, payment_type, callback, user_id)
              VALUES (:create_date, :street, :house, :building, :apartment, :floor, :description, :payment_type, :callback, :us_id);";
    $pdo = connection();
    $stmt = $pdo->prepare($sqlOrder);
    $stmt->bindParam(':create_date', $cr_date);
    $stmt->bindParam(':street', $data['street']);
    $stmt->bindParam(':house', $data['house']);
    $stmt->bindParam(':building', $data['building']);
    $stmt->bindParam(':apartment', $data['apartment']);
    $stmt->bindParam(':floor', $data['floor']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':payment_type', $data['payment_type']);
    $stmt->bindParam(':callback', $data['callback']);
    $stmt->bindParam(':us_id', $userId);
    $stmt->execute();
    $orderId = $pdo->lastInsertId();

    if ($result = sendResponse($orderId, $data, $userId)) {
        return showMailInBrowser($result, $orderId);
    } else {
        return 'Error while sending mail';
    }

}

/**
 * Отправляем письмо с заказом.
 *
 * @param $id
 * @param $data
 * @param $userId
 * @return bool|string
 */
function sendResponse($id, $data, $userId)
{
    $orderNumber = "SELECT COUNT(*) as 'count' FROM orders WHERE user_id = $userId;";
    $pdo = connection();
    $stmt = $pdo->query($orderNumber);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arr = $stmt->fetch();
    $fileName = __DIR__ . './../../orders/' . "Mail_to_$userId-Order-" . $id . ".txt";
    $content = "Заказ # $id" . PHP_EOL .
            "Ваш заказ будет доставлен по адресу:" . PHP_EOL .
            "улица " . $data['street'] . ", " .
            "дом " . $data['house'] . ", " .
            "корпус " . $data['building'] . ", " .
            "квартира " . $data['apartment'] . ", " .
            "этаж " . $data['floor'] . "." . PHP_EOL .
            "Состав заказа: Бургер DarkBeefBurger, 1шт, цена 500р," . PHP_EOL . PHP_EOL;
    if ($arr["count"] === '1') {
        $content = $content . "Спасибо - это ваш первый заказ";
    } else {
        $content = $content . "Спасибо! Это уже " . $arr["count"] . " заказ.";
    }

    if (file_put_contents($fileName, $content)) {
        return $fileName;
    } else {
        return false;
    }
}

function showMailInBrowser($mail, $lastOrderId)
{
    if ($lastOrderId) {
        return file_get_contents($mail);
    } else {
        return 'Something went wrong';
    }
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

