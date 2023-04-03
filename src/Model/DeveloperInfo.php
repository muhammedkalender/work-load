<?php

namespace App\Model;

use App\Entity\Task;

class DeveloperInfo
{
    private $name;
    private $efficiency;
    private $dailyEfficiency;
    private $tasks = [];
    private $taskNormalizedDuration = 0;
    private $taskNormalizedDurationCapacity;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getEfficiency(): int
    {
        return $this->efficiency;
    }

    /**
     * @param int $efficiency
     */
    public function setEfficiency(int $efficiency): void
    {
        $this->efficiency = $efficiency;
    }

    /**
     * @return int
     */
    public function getDailyEfficiency(): int
    {
        return $this->dailyEfficiency;
    }

    /**
     * @param int $dailyEfficiency
     */
    public function setDailyEfficiency(int $dailyEfficiency): void
    {
        $this->dailyEfficiency = $dailyEfficiency;
    }

    /**
     * @param Task $task
     * @return void
     */
    public function addTask(Task $task): void
    {
        $this->tasks[] = $task;
        $this->taskNormalizedDuration += $task->getNormalizedDuration();
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param Task[] $tasks
     */
    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }

    /**
     * @return int
     */
    public function getTaskNormalizedDuration(): int
    {
        return $this->taskNormalizedDuration;
    }

    /**
     * @param int $taskNormalizedDuration
     */
    public function setTaskNormalizedDuration(int $taskNormalizedDuration): void
    {
        $this->taskNormalizedDuration = $taskNormalizedDuration;
    }

    /**
     * @return int
     */
    public function getTaskNormalizedDurationCapacity(): int
    {
        return $this->taskNormalizedDurationCapacity;
    }

    /**
     * @param int $taskNormalizedDurationCapacity
     */
    public function setTaskNormalizedDurationCapacity(int $taskNormalizedDurationCapacity): void
    {
        $this->taskNormalizedDurationCapacity = $taskNormalizedDurationCapacity;
    }


}