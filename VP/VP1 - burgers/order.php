<?php



require_once (__DIR__ . './core/functions/functions.php');
require_once(__DIR__ . './core/config/configure.php');
require_once(__DIR__ . './core/config/connection.php');


if ($_POST) {
    $data = $_POST['data'];
}


echo "<style> body { background: url(img/bg/order.jpg) no-repeat;}</style>";
echo "<font color='white'>"; // Хрень, но работает!

$filledData = formRequiredFields($data);

if ($filledData['result'] == false) {
    foreach ($filledData['errors'] as $errorField => $errorString) {
        echo $errorField . ': ' . $errorString . '</p>';
    }
    exit;
} else {
    $clearData = checkData($filledData['data']);
}

$order = orderBurgers($clearData); // TODO возвращаемый тип проверить, если false

echo '<pre>';
echo $order;
