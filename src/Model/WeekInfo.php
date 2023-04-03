<?php

namespace App\Model;

class WeekInfo
{
    private $weekNumber;
    private $developers;

    /**
     * @return mixed
     */
    public function getWeekNumber()
    {
        return $this->weekNumber;
    }

    /**
     * @param mixed $weekNumber
     */
    public function setWeekNumber($weekNumber): void
    {
        $this->weekNumber = $weekNumber;
    }

    /**
     * @return WeekDeveloperInfo[]
     */
    public function getDevelopers(): array
    {
        return $this->developers;
    }

    /**
     * @param WeekDeveloperInfo[] $developers
     */
    public function setDevelopers(array $developers): void
    {
        $this->developers = $developers;
    }
}