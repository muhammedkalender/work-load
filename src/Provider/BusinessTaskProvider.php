<?php

namespace App\Provider;

use App\Entity\Task;

class BusinessTaskProvider extends AbstractBasicHttpTaskProvider implements TaskProviderInterface
{
    public function __construct()
    {
        parent::__construct('GET', 'https://www.mocky.io/v2/5d47f235330000623fa3ebf7');
    }

    /**
     * @return Task[]
     */
    protected function mapTasks(array $unmappedTaskArray): array
    {
        /** @var Task[] $mappedTaskArray */
        $mappedTaskArray = [];

        foreach ($unmappedTaskArray as $unmappedTask) {
            $taskKey = array_keys($unmappedTask)[0];

            $newTask = new Task();
            $newTask->setName($taskKey);
            $newTask->setDuration($unmappedTask[$taskKey]['estimated_duration']);
            $newTask->setDifficult($unmappedTask[$taskKey]['level']);
            $newTask->setNormalizedDuration($unmappedTask[$taskKey]['estimated_duration'] * $unmappedTask[$taskKey]['level']);

            $mappedTaskArray[] = $newTask;
        }

        return $mappedTaskArray;
    }
}