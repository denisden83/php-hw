<?php
$bmw = [
    "model"=>"X5",
    "speed"=>120,
    "doors"=>5,
    "year"=>2015
];
$toyota['model'] = "RAV4";
$toyota['speed'] = 220;
$toyota['doors'] = 5;
$toyota['year'] = 2017;

$opel = [
    "model"=>"FOCUS",
    "speed"=>200,
    "doors"=>5,
    "year"=>2014
];

$cars = ["bmw"=>$bmw, "toyota"=>$toyota, "opel"=>$opel];

//var_dump($cars);
foreach ($cars as $make => $specs) {
    echo "CAR $make <br />\n";
    foreach ($specs as $key => $value) {
        echo "$key $value; ";
    }
    echo "<br />\n";
}
