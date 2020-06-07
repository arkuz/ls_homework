<?php


namespace Service;

require_once "ConvertTimeFunc.php";

use ConvertTimeFunc\convertTime;


interface I_Service
{
    /**
     * итоговая стоимость услуги перерасчитанная с учетом километража и/или времени
     * @return float
     */
    public function getCalculatedPrice(): float;
}

abstract class Service implements I_Service
{
    use convertTime;

    protected $calculatedPrice;

    /**
     * базовая стоимость услуги
     * @return float
     */
    abstract protected function getServicePrice(): float;

    public function getCalculatedPrice(): float
    {
        return $this->calculatedPrice;
    }
}

/**
 * Class GPSService
 * Услуга Gps в салон - 15 рублей в час, минимум 1 час. Округление в большую сторону.
 * @package Service
 */
class GPSService extends Service
{
    public function __construct(float $minCount)
    {
        $hours = $this->minToHours($minCount);
        if ($hours >= 0 && $hours < 1) {
            $this->calculatedPrice = 0;
        } else {
            $this->calculatedPrice = ceil($hours) * $this->getServicePrice();
        }
    }

    protected function getServicePrice(): float
    {
        return 15;
    }
}

/**
 * Class AdditionalDriverService
 * Услуга Дополнительный водитель - 100 рублей единоразово
 * @package Service
 */
class AdditionalDriverService extends Service
{
    public function __construct()
    {
        $this->calculatedPrice = $this->getServicePrice();
    }

    protected function getServicePrice(): float
    {
        return 100;
    }
}
