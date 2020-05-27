<?php

const NUM_START = 1;
const NUM_FINISH = 10;

$multiTable = [];

function getFormattedValue(&$multiTable, $i, $j)
{
    $curValue = $multiTable[$i][$j];

    if (!($i % 2) && !($j % 2)) {
        return "($curValue)";
    } elseif ($i % 2 && $j % 2) {
        return "[$curValue]";
    } else return "$curValue";
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
        $value = getFormattedValue($multiTable, $i, $j);
        echo "<td> $value </td>";
    }
    echo "</tr>";
}
echo "</table>";
