<?php


namespace Tariff;

require_once "Service.php";
require_once "Types.php";

use Service\I_Service;
use Types\ServiceType;


interface I_Tariff
{
    public function calcPrice();

    public function applyService(I_Service $service);
}

abstract class Tariff implements I_Tariff
{
    protected $kmCount; // кол-во километров
    protected $minCount; // кол-во минут
    protected $tariffName; // название тарифа
    protected $services = []; // массив для услуг

    protected $tariffPrice; // сумма по тарифу
    protected $servicePrice; // сумма по услугам
    protected $totalPrice; // общая сумма тарифа с услугами

    protected $pricePerKm; // стомость километра
    protected $pricePerMin; // стоимость минуты

    public function __construct(float $kmCount, float $minCount)
    {
        $this->kmCount = ($kmCount < 0) ? 0 : $kmCount;
        $this->minCount = ($minCount < 0) ? 0 : $minCount;
    }

    public function applyService(I_Service $service)
    {
        // проверка при добавлении почасовой услуги
        if (isset($service->oneHourAndMore)) {
            $hours = $this->minToHours();
            if ($hours > 0 && $hours < 1) {
                return;
            }
        }
        $this->services[] = $service;
    }

    public function calcServices(): float
    {
        $total = 0;
        if (!empty($this->services)) {
            foreach ($this->services as $service) {
                if ($service->getServiceType() == ServiceType::TYPE_ONE_TIME) {
                    $total += $service->getPrice();
                }
                if ($service->getServiceType() == ServiceType::TYPE_PER_HOUR) {
                    $total += $service->getPrice() * round($this->minToHours());
                }
            }
            return $total;
        }
        return 0;
    }

    public function calcPrice()
    {
        $kmPrice = $this->kmCount * $this->pricePerKm;
        $minPrice = $this->minCount * $this->pricePerMin;

        $this->tariffPrice = $kmPrice + $minPrice;
        $this->servicePrice = $this->calcServices();
        $this->totalPrice = $this->tariffPrice + $this->servicePrice;
    }

    public function calcAndPrintTariff()
    {
        $this->calcServices(); // расчитать услуги
        $this->calcPrice(); // расчитать тариф
        echo "Тариф: {$this->getTariffName()}" . "<br>";
        echo "Километры: {$this->getKmCount()}, минуты: {$this->getMinCount()}" . "<br>";
        if (!empty($this->services)) {
            echo " - Услуги: " . "<br>";
            foreach ($this->services as $service) {
                echo "   - {$service->getServiceName()}" . "<br>";
            }
        }
        echo "Стоимость по тарифу: {$this->getTariffPrice()} р." . "<br>";
        echo "Стоимость услуг: {$this->getServicePrice()} р." . "<br>";
        echo "Общая стоимость: {$this->getTotalPrice()} р." . "<br>";
        echo "-------------------------------" . "<br>";
    }

    public function getKmCount()
    {
        return $this->kmCount;
    }

    public function getMinCount()
    {
        return $this->minCount;
    }

    public function getTariffPrice()
    {
        return $this->tariffPrice;
    }

    public function getServicePrice()
    {
        return $this->servicePrice;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getTariffName()
    {
        return $this->tariffName;
    }

    private function minToHours()
    {
        $minInHour = 60;
        return $this->minCount / $minInHour;
    }
}


class BaseTariff extends Tariff
{
    public function __construct(float $kmCount, float $minCount)
    {
        parent::__construct($kmCount, $minCount);
        $this->tariffName = 'Базовый';
        $this->pricePerKm = 10;
        $this->pricePerMin = 3;
    }
}


class StudentTariff extends BaseTariff
{
    public function __construct(float $kmCount, float $minCount)
    {
        parent::__construct($kmCount, $minCount);
        $this->tariffName = 'Студенческий';
        $this->pricePerKm = 4;
        $this->pricePerMin = 1;
    }
}


class HourlyTariff extends BaseTariff
{
    public function __construct(float $kmCount, float $hourCount)
    {
        // округляем часы в большую сторону и приводим к минутам
        $minCount = ceil($hourCount) * 60;
        parent::__construct($kmCount, $minCount);
        $this->tariffName = 'Почасовой';
        $this->pricePerKm = 0;
        $this->pricePerMin = 200 / 60; // 1 час = 200р., 1 мин = 200 / 60
    }
}

