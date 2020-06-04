<?php

require_once "Service.php";
require_once "Tariff.php";

use Service\GPSService;
use Service\AdditionalDriverService;
use Tariff\BaseTariff;
use Tariff\StudentTariff;
use Tariff\HourlyTariff;


// создаем доп услуги
$gps = new GPSService();
$driver = new AdditionalDriverService();


//создаем тариф и применяем услуги
$bt = new BaseTariff(5, 63);
$bt->applyService($gps);
$bt->applyService($driver);
echo "<pre>";
echo $bt->calcAndPrintTariff();
echo "</pre>";


//создаем тариф и применяем услуги
$st = new StudentTariff(5, 53);
$st->applyService($gps);
$st->applyService($driver);
echo "<pre>";
echo $st->calcAndPrintTariff();
echo "</pre>";

//создаем тариф и применяем услуги
$ht = new HourlyTariff(5, 2.1);
$ht->applyService($gps);
$ht->applyService($driver);
echo "<pre>";
echo $ht->calcAndPrintTariff();
echo "</pre>";

