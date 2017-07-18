<?php
$str = "one two three four five";
echo "<pre>" . var_export($str) . "</pre>";

$arr = explode(' ', $str);
echo "<pre>" . var_export($arr) . "</pre>";

$len = count($arr);
$rev_arr = [];
while ($len--) {
     $rev_arr[] = $arr[$len];
}
echo "<pre>" . var_dump($rev_arr) . "</pre>";

$new_str = implode('#', $rev_arr);
echo "<pre>" . var_dump($new_str) . "</pre>";
