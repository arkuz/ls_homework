<?php

// функция рекурсивно составляет таблицу умножения A на B
// так как мы постоянно декрементим $b, используем $counterB для счета сколько раз уменьшали $b,
// чтобы при переходе на новую строку вновь знать чему было равно $b изначально
function recurMultiTable($a, $b, $arr, $counterB = 0)
{
    if ($a == 1 && $b == 1) {
        $arr[$a][$b] = 1;
        return $arr;
    } else {
        if ($b >= 1) {
            $arr[$a][$b] = $a * $b;
            $b--;
            $counterB++;
        } else {
            $a--;
            $b = $counterB;
            $counterB = 0;
        }
    }
    return recurMultiTable($a, $b, $arr, $counterB);
}

// функция печатает таблицу умножения
function printTable($arr)
{
    $n = sizeof($arr);
    $m = sizeof($arr[1]);
    $numStart = 1;

    echo "<table border='1'>";
    for ($i = $numStart; $i <= $n; $i++) {
        echo "<tr>";
        for ($j = $numStart; $j <= $m; $j++) {
            $value = $arr[$i][$j];
            echo "<td> $value </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

$arr = [];
$a = 4;
$b = 5;

$resArr = recurMultiTable($a, $b, $arr);
echo "<pre>";
print_r($resArr);
echo "</pre>";

printTable($resArr);
