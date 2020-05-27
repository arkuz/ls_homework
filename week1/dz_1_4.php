<?php

$day = rand(0, 10);

echo "День: $day" . "<br>";

switch (true):
    case ($day >= 1 && $day <= 5):
        echo "Это рабочий день";
        break;
    case ($day == 6 || $day == 7):
        echo "Это выходной день";
        break;
    default:
        echo "Неизвестный день";
endswitch;

