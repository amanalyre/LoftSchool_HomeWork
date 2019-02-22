<?php

//function task1()
//{
//    $xml = null;
//    if (file_exists('src/data.xml')) {
//        $xml = simplexml_load_file('src/data.xml');
//    } else {
//        echo('Failed to open data.xml.');
//    }
//
//    if ($xml) {
//        foreach ($xml->Address as $address) {
//            echo $address;
//        }
//    } else {
//        echo "Упс! Ввод деформирован!";
//    }

//    foreach ($xml->Address as $item) {
//        echo "$item '<br />'";

//    }
//}
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
    $table .=  "<td><b>Purchase Order Number</b></td>";
    $table .=  "<td><b>" . $xml['PurchaseOrderNumber'] . "</b></td>";
    $table .=  "</tr>";

    $table .=  "<tr>";
    $table .=  "<td>OrderDate</td>";
    $table .=  "<td>" . $xml['OrderDate'] . "</td>";
    $table .=  "</tr>";

    $table .=   "<tr><td colspan='2' align='center'><b>Delivery notes</b></td></tr>";
    $table .=   "tr><td colspan='2'>$xml->DeliveryNotes</td></tr>";


    $table .=  "<td colspan='2' bgcolor='black'></td>";
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

    echo "<tr>";
    $table .= "<td colspan='2' bgcolor='green'></td>";
    echo "</tr>";
    echo "<td colspan='2' align='center'><b>Items</b></td>";
    echo "</tr>";
    foreach ($xml->Items->Item as $items) {
        echo "<tr>";
        echo "<td>Part number</td>";
        echo "<td>" . $items['PartNumber'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Product Name</td>";
        echo "<td>$items->ProductName</td>";
        echo "</tr>";
        echo "<td>Quantity</td>";
        echo "<td>$items->Quantity</td>";
        echo "</tr>";
        echo "<td>US Price</td>";
        echo "<td>$items->USPrice</td>";
        echo "</tr>";
        echo "<td>Comment</td>";
        echo "<td>$items->Comment</td>";
        echo "</tr>";
        echo "<td>ShipDate</td>";
        echo "<td>$items->ShipDate</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='2' bgcolor='black'>&nbsp;</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo $table;
}

// =====================================================

