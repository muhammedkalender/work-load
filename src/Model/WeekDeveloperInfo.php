<?php

namespace App\Model;

class WeekDeveloperInfo
{
    private $name;
    private $tasks = [];
    private $efficiency;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param WeekTaskInfo $task
     * @return void
     */
    public function addTask(WeekTaskInfo $task): void
    {
        $this->tasks[] = $task;
    }

    /**
     * @return WeekTaskInfo[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param WeekTaskInfo[] $tasks
     */
    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getEfficiency()
    {
        return $this->efficiency;
    }

    /**
     * @param mixed $efficiency
     */
    public function setEfficiency($efficiency): void
    {
        $this->efficiency = $efficiency;
    }

}