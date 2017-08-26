<?php
require_once('functions.php');

#############TASK1
//$arr = ["Hello, how are you?", "Hi, how you going?", "Hey, how you doing?"];
//echo task1($arr, true);

#############TASK2
//$arr = [20, 2, 2];
////$arr = "Hello";
//task2($arr, '/');

#############TASK3
//task3('/', 100, 2.5, 2, 2);

#############TASK4
//task4(10, 7);
#############TASK5

#####variant1
//echo descr("Мир как Рим");
#####variant2
//echo descr("as DFfds da");
#####variant3
//echo descr(isPolindrome("as DFfds a"));

#############TASK6
##----1
//date_default_timezone_set("Europe/Zurich");
//echo '<p>Current unix date/time is ' . time() . "</p>\n";
//$current_date = date("d.m.Y h:i");
//echo "<p>Current date/time is $current_date</p>";
//##----2
//$unix_time = strtotime("24.02.2016 00:00:00");
//echo '<p>24.03.2016 00:00:00 unix format: ' . $unix_time . "</p>\n";
//echo "24.03.2016 00:00:00 обычный формат " . date("d.m.Y h:i:s", $unix_time);
$d = strtotime('01.03.1983');
echo date("Y-m-d", $d);


###########TASK7
//$str = "Карл у Клары украл Кораллы";
//echo $result = preg_replace("/К/", "", $str) . "<br />\n";
//$str2 = "Две бутылки лимонада";
//echo $result = preg_replace("/Две/", "Три", $str2);
###########TASK8
//$str = "RX packets:950381 errors:0 dropped:0 overruns:0 frame:0.
//RX packets:950382 errors:0 dropped:0 overruns:0 frame:0.
//RX packets:955587 errors:0 dropped:0 overruns:0 frame:0.
//RX packets:950985 errors:0 dropped:0 overruns:0 frame:0.";
//task8($str);
###########TASK9
###########TASK10
//file_put_contents('file2.txt', "Hello again!<br />\n", FILE_APPEND);
//echo file_get_contents('file2.txt');
