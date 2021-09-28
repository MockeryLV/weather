<?php


class Initializer{

    private array $forecast;

    public function __construct(array $forecast)
    {

        foreach ($forecast as $item){


                $this->forecast[] = new Weather($item->date, $item->day->avgtemp_c, $item->day->mintemp_c, $item->hour, $item->day->condition->text, $item->day->condition->icon);

        }

    }

    /**
     * @return array
     */
    public function getForecast(): array
    {
        return $this->forecast;
    }
}