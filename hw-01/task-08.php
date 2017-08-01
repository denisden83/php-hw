<?php
$str = 'one two three four five six';
echo '<pre>' . var_export($str) . "</pre>\n";

$arr = explode(' ', $str);
echo '<pre>' . var_export($arr) . "</pre>\n";

$len = count($arr);
$i = 0;
while ($i < $len / 2) {
    $buffer = $arr[$i];
    $arr[$i] = $arr[$len - $i - 1];
    $arr[$len - $i - 1] = $buffer;
    $i++;
}
echo '<pre>' . var_dump($arr) . "</pre>\n";

$new_str = implode('#', $arr);
echo '<pre>' . var_dump($new_str) . "</pre>\n";

//$len = count($arr);
//$rev_arr = [];
//while ($len--) {
//    $rev_arr[] = $arr[$len];
//}
//echo "<pre>" . var_dump($rev_arr) . "</pre>\n";
//
//$new_str = implode('#', $rev_arr);
//echo "<pre>" . var_dump($new_str) . "</pre>\n";
