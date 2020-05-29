<?php

require("src/functions.php");

echo '<b>Задание 1</b><br>';
$arrStrTask1 = ['hello', 'my', 'goodest', 'friend'];
task1($arrStrTask1);
echo '<p>';
echo task1($arrStrTask1, true);
echo '<p>';
// -------------------------------------------------


echo '<b>Задание 2</b><br>';
echo task2('+', 1, 2, 3, 4.5);
echo '<p>';
echo task2('/', 1, 2, 3, 4.5);
echo '<p>';
// -------------------------------------------------


echo '<b>Задание 3</b><br>';
echo task3(5, 8);
echo '<p>';
echo task3(3, 3);
echo '<p>';
// -------------------------------------------------


echo '<b>Задание 4</b><br>';
echo task4_1("Europe/Moscow", "d.m.Y h:i");
echo '<p>';
echo task4_2("24.02.2016 00:00:00");
echo '<p>';
// -------------------------------------------------


echo '<b>Задание 5</b><br>';
echo task5("Карл у Клары украл Кораллы", "К", "");
echo '<p>';
echo task5("Две бутылки лимонада", "Две", "Три");
echo '<p>';
// -------------------------------------------------


echo '<b>Задание 6</b><br>';
$filename = "test.txt";

$writeFile = task6_1($filename, "Hello again!");
if (!$writeFile === false) {
    echo "Файл '$filename' успешно записан";
} else {
    echo "Ошибка при записи файла '$filename'";
}
echo '<p>';

$readFile = task6_2($filename);
if ($readFile === false) {
    echo "Ошибка при чтении файла '$filename'";
} else {
    echo "Содержимое файла '$filename':" . "<br>" . $readFile;
}

