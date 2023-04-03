<?php

namespace App\Provider;

use App\Entity\Task;
use App\Model\ProviderError;

interface TaskProviderInterface
{
    /**
     * @return Task[]|ProviderError
     */
    public function fetchTasks();
}