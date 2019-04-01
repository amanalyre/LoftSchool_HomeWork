<?php

use \controllers\ControllerException;


//запускаем сессию
session_start();

require 'consts.php';
require 'autoloader.php';
require 'bootstrap.php';
$config = include_once 'config.php';

$uri = explode('/', str_replace('mvc/', '', $_SERVER['REQUEST_URI']));


//игнорируем запрос favicon
if (strpos($_SERVER['REQUEST_URI'], 'favicon.ico')) {
    return true;
}
//избавляемся от слеша в начале URI
array_shift($uri);

//вытаскиваем из URI контроллер и следом экшен
$controllerName = $uri[0];
$actionAndParam = explode('?', $uri[1]);
$action = $actionAndParam[0];

$controllerName = !empty($controllerName) ? $controllerName : 'index';
//приводим название контроллера в надлежащий вид
$controllerName = stristr($controllerName, 'Controller') ? $controllerName : ucfirst($controllerName) . 'Controller';


//добавляем namespace
$controllerName = 'controllers\\' . $controllerName;

//ловим пользовательские данные
$userData = !empty($_REQUEST) ? $_REQUEST : [];
//$userData = htmlspecialchars($userData);
//создаем экземпляр контроллера и передаем в него данные
if (!is_subclass_of($controllerName, \controllers\Controller::class)) {
    $controller = new \controllers\NotFoundController();
    $action = 'index';
} else {
  $controller = new $controllerName($userData);
//    if (!method_exists($controller, $action)) {
//        $controller = new \controllers\NotFoundController();
//        $action = 'index';
    }
//}

try {
    //если действия в контроллере нет, ставим по умолчанию
    $action = empty($action) ? 'index' : $action;
    //вызываем действие
    $controller->$action($userData);
} catch (ControllerException $exception) {
    echo $exception->getMessage();
} finally {
    //попробуем найти какой-нибудь view от контроллера
    $html = $controller->hasView() ? $controller->getView() : '';
    echo $html;

}

