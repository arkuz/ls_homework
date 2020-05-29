<?php

/*
Используя цикл for, выведите таблицу умножения размером 10x10. Таблица должна быть выведена с помощью HTML тега <table>.
Если значение индекса строки и столбца чётный, то результат вывести в круглых скобках.
Если значение индекса строки и столбца Нечётный, то результат вывести в квадратных скобках.
Во всех остальных случаях результат выводить просто числом.
*/

const NUM_START = 1;
const NUM_FINISH = 10;

$multiTable = [];

function getFormattedValue($value, $i, $j)
{
    if (!($i % 2) && !($j % 2)) {
        return "($value)";
    }
    if ($i % 2 && $j % 2) {
        return "[$value]";
    }
    return "$value";
}

for($i = NUM_START; $i <= NUM_FINISH; $i++) {
    for($j = NUM_START; $j <= NUM_FINISH; $j++) {
        $multiTable[$i][$j] = $i * $j;
    }
}

echo "<table>";
for($i = NUM_START; $i <= NUM_FINISH; $i++) {
    echo "<tr>";
    for($j = NUM_START; $j <= NUM_FINISH; $j++) {
        $value = getFormattedValue($multiTable[$i][$j], $i, $j);
        echo "<td> $value </td>";
    }
    echo "</tr>";
}
echo "</table>";
