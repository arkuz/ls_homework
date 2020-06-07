<?php

require_once "Service.php";
require_once "Tariff.php";

use Service\I_Service;
use Service\GPSService;
use Service\AdditionalDriverService;
use Tariff\I_Tariff;
use Tariff\BaseTariff;
use Tariff\StudentTariff;
use Tariff\HourlyTariff;

/**
 * получить имя тарифа
 * @param I_Tariff $tariff
 * @return string
 */
function getTariffName(I_Tariff $tariff)
{
    global $tariffsName;
    foreach ($tariffsName as $tName) {
        if ($tName['class'] == get_class($tariff)) {
            return $tName['name'];
        }
    }
    return 'Неизвестный тариф';
}

/**
 * получить имя услуги
 * @param I_Service $service
 * @return string
 */
function getServiceName(I_Service $service)
{
    global $servicesName;
    foreach ($servicesName as $sName) {
        if ($sName['class'] == get_class($service)) {
            return $sName['name'];
        }
    }
    return 'Неизвестная услуга';
}

function printPriceOfTrip(I_Tariff $tariff)
{
    echo "<pre>";
    $tariffName = getTariffName($tariff);
    echo "Тариф: $tariffName" . "<br>";
    echo "Километры: {$tariff->getKmCount()}, минуты: {$tariff->getMinCount()}" . "<br>";
    if (!empty($tariff->getServices())) {
        echo " - Услуги: " . "<br>";
        foreach ($tariff->getServices() as $service) {
            $serviceName = getServiceName($service);
            echo "   - $serviceName - {$service->getCalculatedPrice()} р." . "<br>";
        }
    }
    echo "Стоимость по тарифу: {$tariff->getTariffPrice()} р." . "<br>";
    echo "Стоимость услуг: {$tariff->getServicePrice()} р." . "<br>";
    echo "Общая стоимость: {$tariff->getTotalPrice()} р." . "<br>";
    echo "-------------------------------" . "<br>";
    echo "</pre>";
}


// массив названий тарифов
global $tariffsName;
$tariffsName = [
    [
        'name' => 'Базовый',
        'class' => BaseTariff::class
    ],
    [
        'name' => 'Студенческий',
        'class' => StudentTariff::class
    ],
    [
        'name' => 'Почасовой',
        'class' => HourlyTariff::class
    ],
];


// массив названий услуг
global $servicesName;
$servicesName = [
    [
        'name' => 'GPS в салон',
        'class' => GPSService::class
    ],
    [
        'name' => 'Дополнительный водитель',
        'class' => AdditionalDriverService::class
    ],
];


// создаем доп услуги
$gps = new GPSService(61);
$driver = new AdditionalDriverService();

//создаем тарифы и применяем услуги
$bt = new BaseTariff(5, 61);
$bt->applyService($gps);
$bt->applyService($driver);
$bt->calcPrice();
printPriceOfTrip($bt);

$st = new StudentTariff(5, 53);
$st->applyService($gps);
$st->calcPrice();
printPriceOfTrip($st);

$ht = new HourlyTariff(15, 1.1);
$ht->applyService($gps);
$ht->applyService($driver);
$ht->calcPrice();
printPriceOfTrip($ht);
