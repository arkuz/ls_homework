<?php


namespace Service;

require_once "Types.php";
use Types\ServiceType;

interface I_Service
{
    //public function applyToTariff(); // сделал применение услуги к тарифу

    public function getServiceType(): int;

    public function getServiceName(): string;

    public function getPrice(): float;

}

abstract class Service implements I_Service
{
    protected $serviceName;
    protected $serviceType;
    protected $price;

    public function getServiceType(): int
    {
        return $this->serviceType;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class GPSService extends Service
{
    const DEFAULT_PRICE = 15;

    public $oneHourAndMore = true; // признак, что услуга может быть от 1 часа и более

    public function __construct(float $rubles = self::DEFAULT_PRICE)
    {
        $this->price = ($rubles < 0) ? self::DEFAULT_PRICE : $rubles;
        $this->serviceName = "GPS";
        $this->serviceType = ServiceType::TYPE_PER_HOUR;
    }
}

class AdditionalDriverService extends Service
{
    const DEFAULT_PRICE = 100;

    public function __construct(float $rubles = self::DEFAULT_PRICE)
    {
        $this->price = ($rubles < 0) ? self::DEFAULT_PRICE : $rubles;
        $this->serviceName = "Дополнительный водитель";
        $this->serviceType = ServiceType::TYPE_ONE_TIME;
    }
}