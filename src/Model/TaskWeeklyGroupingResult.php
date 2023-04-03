<?php

namespace App\Model;

class TaskWeeklyGroupingResult
{
    private $neededDays = 0;
    private $neededWeeks = 0;
    private $weeks = [];

    /**
     * @return int
     */
    public function getNeededDays(): int
    {
        return $this->neededDays;
    }

    /**
     * @param int $neededDays
     */
    public function setNeededDays(int $neededDays): void
    {
        $this->neededDays = $neededDays;
    }

    /**
     * @return int
     */
    public function getNeededWeeks(): int
    {
        return $this->neededWeeks;
    }

    /**
     * @param int $neededWeeks
     */
    public function setNeededWeeks(int $neededWeeks): void
    {
        $this->neededWeeks = $neededWeeks;
    }

    /**
     * @return WeekInfo[]
     */
    public function getWeeks(): array
    {
        return $this->weeks;
    }

    /**
     * @param WeekInfo[] $weeks
     */
    public function setWeeks(array $weeks): void
    {
        $this->weeks = $weeks;
    }
}