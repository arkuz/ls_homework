<?php

/*
Создайте массив $bmw с ячейками:
model
speed
doors
year

Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”.
Создайте массивы $toyota' и '$opel аналогичные массиву $bmw (заполните данными).
Объедините три массива в один многомерный массив.
Выведите значения всех трех массивов в виде:

CAR type
model ­ speed ­ doors ­ year

Например:
CAR bmw
X5 ­ 120 ­ 5 ­ 2015
*/

const MODEL = 'model';
const SPEED = 'speed';
const DOORS = 'doors';
const YEAR = 'year';

const BMW = 'bmv';
const TOYOTA = 'toyota';
const OPEL = 'opel';

$bmw[MODEL] = 'X5';
$bmw[SPEED] = 120;
$bmw[DOORS] = 5;
$bmw[YEAR] = '2015';

$toyota[MODEL] = 'Corolla';
$toyota[SPEED] = 200;
$toyota[DOORS] = 5;
$toyota[YEAR] = '2017';

$opel[MODEL] = 'Astra';
$opel[SPEED] = 180;
$opel[DOORS] = 5;
$opel[YEAR] = '2012';

$cars = [
    BMW => $bmw,
    TOYOTA => $toyota,
    OPEL => $opel,
];

foreach ($cars as $car => $params) {
    $paramString = '';
    echo "CAR - $car" . "<br>";
    foreach ($params as $key => $value) {
        $paramString .= "$value ";
    }
    echo $paramString . "<br><br>";
}

