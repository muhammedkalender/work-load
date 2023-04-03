<?php

namespace App\Service;

use App\Entity\Task;
use App\Model\TaskDistributionResult;
use App\Model\WeekInfo;

interface TaskDistributionServiceInterface
{
    /**
     * @return TaskDistributionResult
     */
    public function calculateWorkloadWithDefaultParameters(): TaskDistributionResult;

    /**
     * @param Task[] $tasks
     * @param integer[] $developerInfos
     * @param int $weeklyHours
     * @return TaskDistributionResult
     */
    public function calculateTaskDistribution(array $tasks, array $developerInfos, int $weeklyHours = 45): TaskDistributionResult;

    /**
     * @param TaskDistributionResult $distributionResult
     * @return WeekInfo[]
     */
    public function weeklyGroup(TaskDistributionResult $distributionResult, int $weeklyHours = 45): array;
}