<?php


namespace ConvertTimeFunc;


trait convertTime
{
    /**
     * функция конвертирует минуты в часы
     * @param $minCount
     * @return float
     */
    function minToHours($minCount): float
    {
        return $minCount / 60;
    }

    /**
     * функция конвертирует часы в минуты
     * @param $hoursCount
     * @return float
     */
    function hoursToMin($hoursCount): float
    {
        return $hoursCount * 60;
    }
}

