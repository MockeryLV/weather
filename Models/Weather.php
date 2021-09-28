<?php


class Weather{

    private string $day;
    private float $avgTemp;
    private float $lTemp;
    private array $hours;
    private string $condition;
    private string $icon;

    public function __construct(string $day, float $avgTemp, float $lTemp, array $hours, string $condition, string $icon)
    {
        $this->day = $day;
        $this->avgTemp = $avgTemp;
        $this->lTemp = $lTemp;
        $this->hours = $hours;
        $this->condition = $condition;
        $this->icon = $icon;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function getAvgTemp(): float
    {
        return $this->avgTemp;
    }

    public function getLTemp(): float
    {
        return $this->lTemp;
    }

    /**
     * @return array
     */
    public function getHours(): array
    {
        return $this->hours;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }
}