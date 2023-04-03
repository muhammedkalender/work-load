<?php

namespace App\Provider;

use App\Entity\Task;

class ITTaskProvider extends AbstractBasicHttpTaskProvider implements TaskProviderInterface
{
    public function __construct()
    {
        parent::__construct('GET', 'https://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
    }

    protected function mapTasks(array $unmappedTaskArray): array
    {
        /** @var Task[] $mappedTaskArray */
        $mappedTaskArray = [];

        foreach ($unmappedTaskArray as $unmappedTask) {
            $newTask = new Task();
            $newTask->setName($unmappedTask['id']);
            $newTask->setDuration($unmappedTask['sure']);
            $newTask->setDifficult($unmappedTask['zorluk']);
            $newTask->setNormalizedDuration($unmappedTask['sure'] * $unmappedTask['zorluk']);

            $mappedTaskArray[] = $newTask;
        }

        return $mappedTaskArray;
    }
}