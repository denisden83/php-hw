<?php
$day = rand(0, 10);
echo "<br>$day <br />\n";
switch ((integer)$day) {
    case 0:
        echo 'There\'s no such a day!';
        break;
    case ($day >= 1 && $day <= 5):
        echo 'Это рабочий день';
        break;
    case ($day == 6 || $day == 7):
        echo 'Это выходной день';
        break;
    default:
        echo 'There\'s no such a day!';
}
$day = 0;
echo "<br>0 == ($day >= 1 && $day <= 5)<br>";
var_dump(0 == ($day >= 1 && $day <= 5));
echo "<br>0 == ($day == 6 || $day == 7)<br>";
var_dump(0 == ($day == 6 || $day == 7));
$day = 2;
echo "<br>2 == ($day >= 1 && $day <= 5)<br>";
var_dump(2 == ($day >= 1 && $day <= 5));
echo "<br>2 == ($day == 6 || $day == 7)<br>";
var_dump(2 == ($day == 6 || $day == 7));
$day = 6;
echo "<br>6 == ($day >= 1 && $day <= 5)<br>";
var_dump(6 == ($day >= 1 && $day <= 5));
echo "<br>6 == ($day == 6 || $day == 7)<br>";
var_dump(6 == ($day == 6 || $day == 7));
$day = 9;
echo "<br>9 == ($day >= 1 && $day <= 5)<br>";
var_dump(9 == ($day >= 1 && $day <= 5));
echo "<br>9 == ($day == 6 || $day == 7)<br>";
var_dump(9 == ($day == 6 || $day == 7));
