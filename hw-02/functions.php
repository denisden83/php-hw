<?php
###########TASK1###########################
function task1($arr, $bool = false)
{
    $str = "";
    if ($bool != true) {
        foreach ($arr as $v) {
            echo "<p>$v</p>\n";
        }
    } else {
        $str = join(" ", $arr) . "<br />\n";
    }
    return $str;
}
##########TASK2###################3
function task2($arr, $operator = null)
{
    if (!is_array($arr)) {
        echo "##$arr## не массив";
    } elseif (count($arr) < 2) {
        echo "В массиве меньше 2-х чисел";
    } else {
        $result = $arr[0];
        for ($i = 1; $i < count($arr); $i++) {
            switch ($operator) {
                case '+':
                    $result += $arr[$i];
                    break;
                case '-':
                    $result -= $arr[$i];
                    break;
                case '*':
                    $result *= $arr[$i];
                    break;
                case '/':
                    if ($arr[$i] === 0) {
                        echo " Дeление на 0!";
                        return;
                    } else {
                        $result /= $arr[$i];
                    }
                    break;
                case null:
                    $result = 'Укажите оператор';
                    break(2);
                default:
                    $result = "'$operator' не арифметический оператор";
                    break(2);
            }
        }
//        echo ($result != INF) ? $result : "!!!Деление на ноль";
        echo $result;
    }
}


############TASK3###########################
function task3(...$numbers)
{
    if ($numbers[0] == '+' || $numbers[0] == '-' || $numbers[0] == '*' || $numbers[0] == '/') {
        $oper = array_shift($numbers);
        foreach ($numbers as $number) {
            if (!(is_int($number) || is_double($number))) {
                echo " '$number' не число";
                return;
            }
        }
        if (count($numbers) < 2) {
            echo "В массиве меньше 2-х чисел";
        } else {
            $result = $numbers[0];
            for ($i = 1; $i < count($numbers); $i++) {
                switch ($oper) {
                    case '+':
                        $result += $numbers[$i];
                        break;
                    case '-':
                        $result -= $numbers[$i];
                        break;
                    case '*':
                        $result *= $numbers[$i];
                        break;
                    case '/':
                        if ($numbers[$i] === 0) {
                            echo " Дeление на 0!";
                            return;
                        } else {
                            $result /= $numbers[$i];
                        }
                        break;
                }
            }
            echo $result;
        }
    } else {
        echo "Первый аргумент должен быть арифм оператор";
    }
}

############TASK4###################

#------variant1 with generator
function generator($to, $from = 1)
{
    for ($i = $from; $i <= $to; $i++) {
        yield $i;
    }
}
function task4($num1, $num2)
{
    if (is_int($num1) && is_int($num2)) {
        echo "<table style='border: 5px dashed black;'>\n";
        foreach (generator($num1) as $value) {
            echo "<tr>";
            foreach (generator($num2) as $item) {
                echo "<td style='border: 5px dashed lime;'>" . $value * $item . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Введены не целые числа";
    }
}
#------variant2
//function task4($num1, $num2)
//{
//    if (is_int($num1) && is_int($num2)) :
//        echo "<table>\n";
//        for ($i = 1; $i <= $num1; $i++) :
//            echo "<tr>";
//            for ($j = 1; $j <= $num2; $j++) :
//                echo "<td>" . $i * $j . "</td>";
//            endfor;
//            echo "</tr>\n";
//        endfor;
//        echo "</table>";
//    else :
//        echo "Введены не целые числа";
//    endif;
//}
############TASK5#####################

function utf8_strrev($str)
{
    preg_match_all('/./us', $str, $ar);
    return join('', array_reverse($ar[0]));
}

function isPolindrome($str)
{
    $str = str_replace(" ", "", $str);
    $str = mb_strtolower($str);
    $newstr = utf8_strrev($str);
    echo $newstr . " <br />\n";
    if ($str === $newstr) {
        return true;
    } else {
        return false;
    }
}
#----variant1
function descr($str)
{
    $bool = call_user_func("isPolindrome", $str);
    if ($bool) {
        return "\\$str\\  введённая строка - палиндром";
    } else {
        return "\\$str\\  введённая строка не палиндром";
    }
}
#-----variant2
//function descr($str)
//{
//    $bool = isPolindrome($str);
//    if ($bool) {
//        return "\\$str\\  введённая строка - палиндром";
//    } else {
//        return "\\$str\\ введённая строка не палиндром";
//    }
//}
#------variant3
//function descr($bool)
//{
//    if ($bool) {
//        return " введённая строка - палиндром";
//    } else {
//        return " введённая строка не палиндром";
//    }
//}

############TASK6###################
############TASK7###################
############TASK8###################
function smile()
{
    echo "<pre>

               \|/ ____ \|/       
                @~/ ,. \~@        
               /_( \__/ )_\       
                  \__U_/     </pre>";
}
function task8($str)
{
    if (preg_match("|:\)|", $str)) {
        smile();
    } else {
        preg_match_all("|RX\s?packets:\d+|", $str, $matches);
//        print_r($matches);
//        echo "<br />\n";
        foreach ($matches[0] as $v) {
            preg_match("|\d+|", $v, $result_arr);
//            print_r($result_arr);
//            echo "<br />\n";
//            echo $result_arr[0];
//            echo "<br />\n";
            if ($result_arr[0] > 1000) {
                echo "$v Сеть есть<br />\n";
            }
        }
    }
}
############TASK9########################
############TASK10########################
