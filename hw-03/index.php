<?php
require_once('functions.php');
#######TASK1#####
//$file = 'data.xml';
//task1($file);
#######TASK2#####

$arr = [
    'Europe' => [
        'Germany' => 'Berlin',
        'France' => 'Paris',
        'Spain' => 'Madrid'
    ],
    'Asia' => [
        'China' => 'Beijing',
        'Thailand' => 'Bankog',
        'Nepal' => 'Kathmandu'
    ]
];
task2($arr);

#######TASK3#####
//from-to диапазон
//numOfElemInSubArr количество чисел в подмассиве
//numOfSubArr количество подмассивов
//echo task3(createArr(1, 100, 2, 3));
#######TASK4#####
//$host = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";
//$lookForArr = ["title", "pageid", "what"];
//task4($host, $lookForArr);
