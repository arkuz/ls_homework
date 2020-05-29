<?php

function task1(array $arrStr, bool $print = false)
{
    $str = '';
    foreach ($arrStr as $word) {
        if (!$print) {
            echo "<p> $word </p>";
            continue;
        }
        $str .= $word . ' ';
    }
    if ($print) {
        return $str;
    }
}


function task2(... $args): string
{
    if (empty($args)) {
        throw new Exception('Список аргументов пуст');
    }

    if (sizeof($args) == 1) {
        throw new Exception('Недостаточно аргументов для выполнения операции');
    }

    $actionsArray = ['+', '-', '*', '/'];
    $action = $args[0];
    if (!in_array($action, $actionsArray, true)) {
        throw new Exception('Некорректная математическая операция');
    }

    $total = $args[1];
    $solutionStr = $total;
    unset($args[0], $args[1]); // убираем из массива аргументов операцию и первое значение

    foreach ($args as $value) {

        if (!is_int($value) && !is_float($value)) {
            throw new Exception('Тип элемента должен быть INT или FLOAT');
        }

        switch ($action) {
            case '+':
                $total += $value;
                break;
            case '-':
                $total -= $value;
                break;
            case '*':
                $total *= $value;
                break;
            case '/':
                $total /= $value;
                break;
        }
        $solutionStr .= " $action " . $value;
    }
    return $solutionStr . " = " . round($total, 2);
}


function task3(int $a, int $b)
{
    if ($a <= 0 || $b <= 0) {
        throw new Exception('Элементы должны быть больше нуля');
    }

    $numStart = 1;
    echo "<table>";
    for ($i = $numStart; $i <= $a; $i++) {
        echo "<tr>";
        for ($j = $numStart; $j <= $b; $j++) {
            $value = $i * $j;
            echo "<td> $value </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


function task4_1(string $timezone, string $format): string
{
    date_default_timezone_set($timezone);
    return date($format);
}


function task4_2(string $dateStr): int
{
    return strtotime($dateStr);
}


function task5(string $str, string $subStr, string $replace)
{
    return str_replace($subStr, $replace, $str);
}


function task6_1(string $filename, $data)
{
    return file_put_contents($filename, $data);
}


function task6_2(string $filename)
{
    return file_get_contents($filename);
}
