<?php

/**
 * Принимает на вход xml и отрисовывает таблицу заказа
 * @return null|string
 */
function task1()
{
    $xml = null;
    if (file_exists('src/data.xml')) {
        $xml = simplexml_load_file('src/data.xml');
    } else {
        echo('Failed to open data.xml.');
    }

    $table = null;

    $table .=  "<table>";

    $table .=  "<tr>";
    $table .=  "<td><b>Purchase Order Number  </b></td>";
    $table .=  "<td><b>" . $xml['PurchaseOrderNumber'] . "</b></td>";
    $table .=  "</tr>";

    $table .=  "<tr>";
    $table .=  "<td>OrderDate</td>";
    $table .=  "<td>" . $xml['OrderDate'] . "</td>";
    $table .=  "</tr>";

    $table .=   "<tr><td colspan='2' align='center'><b>Delivery notes</b></td></tr>";
    $table .=   "<tr><td colspan='2'>$xml->DeliveryNotes</td></tr>";


    $table .=  "<td colspan='2' bgcolor='black'></td>";
    $table .= "<tr><td colspan='2' bgcolor='green'></td></tr>";
    foreach ($xml->Address as $address) {
        $table .= "<tr><td colspan='2' align='center'><b>" . $address['Type'] . "</b></td></tr>";
        $table .= "<tr><td>Name</td>";
        $table .= "<td>$address->Name</td></tr>";
        $table .= "<tr><td>Street</td>";
        $table .= "<td>$address->Street</td></tr>";
        $table .= "<tr><td>City</td>";
        $table .= "<td>$address->City</td></tr>";
        $table .= "<tr><td>State</td>";
        $table .= "<td>$address->State</td></tr>";
        $table .= "<tr><td>Name</td>";
        $table .= "<td>$address->Name</td></tr>";
        $table .= "<tr><td>Zip</td>";
        $table .= "<td>$address->Zip</td></tr>";
        $table .= "<tr><td>Country</td>";
        $table .= "<td>$address->Country</td></tr>";
        $table .= "<td colspan='2' bgcolor='black'></td>";
    }

    $table .= "<tr><td colspan='2' bgcolor='green'></td></tr>";
    $table .= "<tr><td colspan='2' align='center'><b>Items</b></td></tr>";

    foreach ($xml->Items->Item as $item) {
        $table .= "<tr><td>Part number</td>";
        $table .= "<td>" . $item['PartNumber'] . "</td></tr>";
        $table .= "<tr></tr><td>Product Name</td>";
        $table .= "<td>$item->ProductName</td></tr>";
        $table .= "<tr></tr><td>Quantity</td>";
        $table .= "<td>$item->Quantity</td></tr>";
        $table .= "<tr></tr><td>US Price</td>";
        $table .= "<td>$item->USPrice</td></tr>";
        $table .= "<tr></tr><td>Comment</td>";
        $table .= "<td>$item->Comment</td></tr>";
        $table .= "<tr><td>ShipDate</td>";
        $table .= "<td>$item->ShipDate</td></tr>";
        $table .= "<tr><td colspan='2' bgcolor='black'></td></tr>";;
    }
    $table .= "</table>";
    return $table;
}

/**
 * @return string
 */
function task2()
{
    $array = [
            'Russia' =>
                    [
                            'capital' => 'Moscow',
                            'language' => 'Russian'
                    ],
            'France' =>
                    [
                            'capital' => 'Paris',
                            'language' => 'French'
                    ],
            'Spain' =>
                    [
                            'capital' => 'Madrid',
                            'language' => 'Spanish'
                    ]

    ];
    $arrayToJson = json_encode($array);

    file_put_contents('someJson.json', $arrayToJson);
    $json = file_get_contents('someJson.json');
    $tempArray = json_decode($json, true);
    if (rand(0, 1)) {
        $newPart = [
                'Austria' =>
                        [
                                'capital' => 'Vienna',
                                'language' => 'Deutsche'
                        ]
        ];
        array_push($tempArray, $newPart);
    }

    $changedJson = json_encode($tempArray);
    file_put_contents('someJson2.json', $changedJson);

    $firstJson = file_get_contents("someJson.json");
    $secondJson = file_get_contents("someJson2.json");
    $first = json_decode($firstJson, true);
    $second = json_decode($secondJson, true);
    $diff = array_diff_assoc($second, $first);
    $jsonDiff = json_encode($diff);
    if (!$jsonDiff === []) { //TODO допилить правильную проверку []
        echo "</br>Отличающиеся элементы: ";
    } else {
        echo 'Нет отличий: ';
    }
    return $jsonDiff;
}

/**
 * @return int
 */
function task3()
{
    $arrayToCSV = [];
    for($i = 0; $i <= 50; $i++) {
        $arrayToCSV[] = rand(1,100);
    }

    $fCsv = fopen('randNum.csv', 'w');
    $writen = fputcsv($fCsv, $arrayToCSV, ';');
    if ($writen) {
        true;
    } else {
        echo 'Ошибка при записи в файл.';
    }
    fclose($fCsv);

    $fCsv = fopen('randNum.csv', 'rt');
    $numbers = fgetcsv($fCsv, 1000, ";");

    $sum = 0;
    foreach ($numbers as $number) {
        if ($number % 2 == 0) {
            $sum += $number;
        }
    }
    echo 'Сумма чётных чисел: ';
    return $sum;
}

/**
 * @return bool
 */
function task4()
{
    $uri = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&r
vprop=content&format=json';
    $rawdata = file_get_contents($uri);
    $data = json_decode($rawdata, true);
    $search = function ($found, $key)
    {
        if($key == 'pageid' || $key == 'title') {
            echo "<b>$key</b> - $found</br>";
        }
    };
    $result = array_walk_recursive($data, $search);

    if ($result) {
        return "Результаты поиска.";
    }
}