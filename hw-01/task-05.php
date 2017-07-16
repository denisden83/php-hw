<?php
$day = rand(0, 10);
$day = 0; //почему 0 поподает в первый case?
echo "$day <br />\n";

switch ($day) {
    case ($day >= 1 && $day <= 5):
        echo "Это рабочий день " . gettype($day);
        break;
    case ($day == 6 || $day == 7):
        echo "Это выходной день";
        break;
    default:
        echo "There's no such a day";
}
