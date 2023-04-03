<?php

namespace App\Model;

class TaskDistributionResult
{
    private $neededDays = 0;
    private $neededWeeks = 0;
    private $developers = [];

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
     * @return DeveloperInfo[]
     */
    public function getDevelopers(): array
    {
        return $this->developers;
    }

    /**
     * @param array $developers
     */
    public function setDevelopers(array $developers): void
    {
        $this->developers = $developers;
    }
}