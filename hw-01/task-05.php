<?php
$day = rand(0, 10);
//$day = 8;
echo "$day <br />\n";

switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo 'Это рабочий день ';
        break;
    case 6:
    case 7:
        echo 'Это выходной день';
        break;
    default:
        echo 'There\'s no such a day!';
}
