<?php
//######TASK1#####
function task1($file)
{
    $xml = simplexml_load_file($file) or die('Error: Cannot create object');
    echo "ORDER N" . $xml['PurchaseOrderNumber'] . " DATE: $xml[OrderDate]\n<br /><br />";

    foreach ($xml->Address as $address) {
        echo mb_strtoupper($address['Type']) . " ADDRESS:\n<br />";
        echo "Name - " . $address->Name . "\n<br />";
        echo "Street - " . $address->Street . "\n<br />";
        echo "City - " . $address->City . "\n<br />";
        echo "State - " . $address->State . "\n<br />";
        echo "Country - " . $address->Country . "\n<br /><br />";
    }

    echo "DELIVERY NOTES:\n<br /> $xml->DeliveryNotes\n<br /><br />";

    echo "ITEMS:\n<br />";
    foreach ($xml->Items->Item as $item) {
        echo "Item part number: $item[PartNumber]\n<br />";
        echo "Quantity - $item->Quantity\n<br />";
        echo "US Price - $item->USPrice\n<br />";
        echo "Ship Date - $item->ShipDate\n<br />";
        echo "Comment - $item->Comment\n<br /><br />";
    }
}
//######TASK2#####

function task2($arr)
{
    $fileJson = 'output.json';
    $fileJson2 = 'output2.json';

    file_put_contents($fileJson, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $data = json_decode(file_get_contents($fileJson), true);

    if (mt_rand(0, 1)) {
        $data['Europe']['Germany'] = 'Берлин';
        $data['Asia']['China'] = 'Пекин';
    }
    file_put_contents($fileJson2, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $dataJson = json_decode(file_get_contents($fileJson), true);
    $dataJson2 = json_decode(file_get_contents($fileJson2), true);

    $result = array_diff_assoc($dataJson, $dataJson2);
    foreach ($dataJson as $k => $v) {
        if (is_array($dataJson[$k]) && is_array($dataJson2[$k])) {
            $result[] = array_diff_assoc($dataJson[$k], $dataJson2[$k]);
        }
    }
    function getherDifferences($arr)
    {
        static $result = "";
        foreach ($arr as $k => $v) {
            if (!is_array($v)) {
                $result .= "$k - $v\n<br />";
            } else {
                getherDifferences($v);
            }
        }
        return $result;
    }
     $finalResult = getherDifferences($result);


    if (empty($finalResult)) {
        echo "Отличий нет";
    } else {
        echo "Найденные различия:\n<br />";
        echo $finalResult . "<br />";
        echo "Массив различий:";
        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }

//    echo "<pre>";
//    print_r($dataJson);
//    echo "</pre>";
//    echo "<pre>";
//    print_r($dataJson2);
//    echo "</pre>";
}

//######TASK3#####
function createArr($from, $to, $numOfElemInSubArr, $numOfSubArr)
{
    $subArr = [];
    for ($j = 0; $j < $numOfSubArr; $j++) {
        $arr = [];
        for ($i = 0; $i < $numOfElemInSubArr; $i++) {
            $arr[] = mt_rand($from, $to);
        }
        $subArr[] = $arr;
    }
    return $subArr;
}

function task3($arr)
{
//    echo "<pre>";
//    print_r($arr);
//    echo "</pre>";

    $f = fopen('file.csv', 'w+t') or die("Ошибка!");
    foreach ($arr as $k => $v) {
        fputcsv($f, $v);
    }

    $f = fopen('file.csv', 'r+t') or die("Ошибка!");
    $sum = 0;
    $dataFinalArr = [];
    while (($dataArr = fgetcsv($f)) !== false) {
        foreach ($dataArr as $data) {
            $sum += $data;
        }
//        echo "<pre>";
//        print_r($dataArr);
//        echo "</pre>";
        $dataFinalArr[] = $dataArr;
    }
    return $sum;

//    echo "<pre>";
//    print_r($dataFinalArr);
//    echo "</pre>";
}


//######TASK4#####
function loopArray($arr, $searchfor)
{
    static $result = [];

    foreach ($arr as $k => $v) {
        if ($k === $searchfor) {
            $result[$k] = $v;
        }
        if (is_array($arr[$k])) {
            loopArray($v, $searchfor);
        }
    }
    return $result;
}
function task4($host, $searchForArr)
{
    $curl = curl_init($host);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);
    $arr = json_decode($content, true);

    $res = [];
    foreach ($searchForArr as $searchForItem) {
        $res = loopArray($arr, $searchForItem);
    }
    foreach ($res as $k => $v) {
        echo "$k: $v\n<br />";
    }

//    echo "<pre>";
//    print_r($res);
//    echo "</pre>";
}
