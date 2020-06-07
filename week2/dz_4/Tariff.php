<?php


namespace Tariff;

require_once "Service.php";

use ConvertTimeFunc\convertTime;
use Service\I_Service;


interface I_Tariff
{
    public function calcPrice();

    public function applyService(I_Service $service);
}

abstract class Tariff implements I_Tariff
{
    /**
     * кол-во километров
     * @var float|int
     */
    protected $kmCount;

    /**
     * кол-во минут
     * @var float|int
     */
    protected $minCount;
    /**
     * массив добавленных услуг
     * @var array
     */
    protected $services = [];
    /**
     * сумма по тарифу
     * @var
     */
    protected $tariffPrice;
    /**
     * сумма по услугам
     * @var
     */
    protected $servicePrice;
    /**
     * общая сумма тарифа с услугами
     * @var
     */
    protected $totalPrice;

    public function __construct(float $kmCount, float $minCount)
    {
        $this->kmCount = ($kmCount <= 0) ? 1 : $kmCount;
        $this->minCount = ($minCount <= 0) ? 1 : $minCount;
    }

    /**
     * цена тарифа за километр
     * @return float
     */
    abstract protected function getPricePerKm(): float;

    /**
     * цена тарифа за минуту
     * @return float
     */
    abstract protected function getPricePerMin(): float;

    /**
     * метод добавления услуги к тарифу
     * @param I_Service $service
     */
    public function applyService(I_Service $service)
    {
        if ($service->getCalculatedPrice() > 0) {
            $this->services[] = $service;
        }
    }

    /**
     * метод расчета стоимости всех услуг
     * @return float
     */
    public function calcServices(): float
    {
        $total = 0;
        if (!empty($this->services)) {
            foreach ($this->services as $service) {
                $total += $service->getCalculatedPrice();
            }
        }
        return $total;
    }

    /**
     * метод расчета полной стоимости тарифа с учетом услуг
     */
    public function calcPrice()
    {
        $kmPrice = $this->kmCount * $this->getPricePerKm();
        $minPrice = $this->minCount * $this->getPricePerMin();

        $this->tariffPrice = $kmPrice + $minPrice;
        $this->servicePrice = $this->calcServices();
        $this->totalPrice = $this->tariffPrice + $this->servicePrice;
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

    public function getServices()
    {
        return $this->services;
    }

}

/**
 * Class BaseTariff
 * Базовый тариф
 * @package Tariff
 */
class BaseTariff extends Tariff
{
    protected function getPricePerKm(): float
    {
        return 10;
    }

    protected function getPricePerMin(): float
    {
        return 3;
    }
}

/**
 * Class StudentTariff
 * Студенческий тариф
 * @package Tariff
 */
class StudentTariff extends BaseTariff
{
    protected function getPricePerKm(): float
    {
        return 4;
    }

    protected function getPricePerMin(): float
    {
        return 1;
    }
}

/**
 * Class HourlyTariff
 * Почасовой тариф
 * @package Tariff
 */
class HourlyTariff extends BaseTariff
{
    use convertTime;

    public function __construct(float $kmCount, float $hourCount)
    {
        $minCount = $this->hoursToMin(ceil($hourCount));
        parent::__construct($kmCount, $minCount);
    }

    protected function getPricePerKm(): float
    {
        return 0;
    }

    protected function getPricePerMin(): float
    {
        return 200 / 60; // 1 час = 200р., 1 мин = 200 / 60
    }
}

