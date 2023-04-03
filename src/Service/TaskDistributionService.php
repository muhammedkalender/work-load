<?php

namespace App\Service;

use App\Entity\Task;
use App\Model\DeveloperInfo;
use App\Model\TaskDistributionResult;
use App\Model\WeekDeveloperInfo;
use App\Model\WeekInfo;
use App\Model\WeekTaskInfo;
use App\Repository\TaskRepository;
use Exception;

class TaskDistributionService implements TaskDistributionServiceInterface
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @throws Exception
     */
    public function calculateWorkloadWithDefaultParameters(): TaskDistributionResult
    {
        $developers = [
            'DEV1' => 1,
            'DEV2' => 2,
            'DEV3' => 3,
            'DEV4' => 4,
            'DEV5' => 5,
        ];

        return $this->calculateTaskDistribution($this->taskRepository->findAllOrderByNormalizedDuration(), $developers);
    }

    /**
     * @param Task[] $tasks
     * @param integer[] $developerInfos
     * @param int $weeklyHours
     * @return TaskDistributionResult
     * @throws Exception
     */
    public function calculateTaskDistribution(array $tasks, array $developerInfos, int $weeklyHours = 45): TaskDistributionResult
    {
        $dailyHours = $weeklyHours / 5;

        $developers = [];

        $dailyTaskCapacity = array_sum(array_map(function ($developer) use ($dailyHours) {
            return $developer * $dailyHours;
        }, $developerInfos));

        $totalNormalizedTaskDuration = array_sum(array_map(function ($task) {
            return $task->getNormalizedDuration();
        }, $tasks));

        $neededDays = ceil($totalNormalizedTaskDuration / $dailyTaskCapacity);

        foreach ($developerInfos as $key => $developerInfo) {
            $developer = new DeveloperInfo();
            $developer->setName($key);
            $developer->setEfficiency($developerInfo);
            $developer->setDailyEfficiency($developerInfo * $dailyHours);
            $developer->setTaskNormalizedDurationCapacity($developerInfo * $dailyHours * $neededDays);


            $developers[] = $developer;
        }

        usort($developers, function (DeveloperInfo $a, DeveloperInfo $b) {
            return $b->getEfficiency() <=> $a->getEfficiency();
        });

        foreach ($tasks as $task) {
            $hasAssigned = false;

            foreach ($developers as $developer) {
                if ($developer->getTaskNormalizedDuration() + $task->getNormalizedDuration() <= $developer->getTaskNormalizedDurationCapacity()) {
                    $developer->addTask($task);
                    $hasAssigned = true;
                    break;
                }
            }

            if (!$hasAssigned) {
                throw new Exception('Algorithmic error');
            }
        }

        $result = new TaskDistributionResult();
        $result->setDevelopers($developers);
        $result->setNeededDays($neededDays);
        $result->setNeededWeeks(ceil($neededDays / 5));

        return $result;
    }

    public function weeklyGroup(TaskDistributionResult $distributionResult, int $weeklyHours = 45): array
    {
        /** @var WeekInfo[] $groupByWeeks */
        $groupByWeeks = [];

        for ($i = 0; $i < $distributionResult->getNeededWeeks(); $i++) {
            $week = new WeekInfo();
            $week->setWeekNumber($i + 1);

            $developers = [];

            foreach ($distributionResult->getDevelopers() as $developer) {
                $weekDeveloper = new WeekDeveloperInfo();
                $weekDeveloper->setName($developer->getName());
                $weekDeveloper->setEfficiency($developer->getEfficiency());
                $weekDeveloper->setTasks([]);

                $developers[] = $weekDeveloper;
            }

            $week->setDevelopers(array_replace([], $developers));

            $groupByWeeks[] = $week;
        }

        foreach ($distributionResult->getDevelopers() as $developerIndex => $developer) {
            $week = 0;
            $developerWeeklyNormalizedEfficiency = $developer->getEfficiency() * $weeklyHours;
            $remeaningDeveloperNormalizedDuration = $developerWeeklyNormalizedEfficiency;

            foreach ($developer->getTasks() as $task) {
                $remainingTaskNormalizedDuration = $task->getNormalizedDuration();

                while ($remainingTaskNormalizedDuration > 0) {
                    if ($remeaningDeveloperNormalizedDuration >= $remainingTaskNormalizedDuration) {
                        $usedNormalizedDuration = $remainingTaskNormalizedDuration;
                        $remeaningDeveloperNormalizedDuration -= $remainingTaskNormalizedDuration;
                    } else {
                        $usedNormalizedDuration = $remeaningDeveloperNormalizedDuration;
                        $remeaningDeveloperNormalizedDuration = 0;
                    }

                    $groupByWeeks[$week]->getDevelopers()[$developerIndex]->addTask($this->createWeekTaskInfo($task, $developer->getEfficiency(), $remainingTaskNormalizedDuration, $usedNormalizedDuration));

                    $remainingTaskNormalizedDuration -= $usedNormalizedDuration;

                    if ($remeaningDeveloperNormalizedDuration == 0) {
                        $week++;
                        $remeaningDeveloperNormalizedDuration = $developerWeeklyNormalizedEfficiency;
                    }
                }
            }
        }

        return [
            'neededDays' => $distributionResult->getNeededDays(),
            'neededWeeks' => $distributionResult->getNeededWeeks(),
            'data' => $groupByWeeks
        ];
    }

    private function createWeekTaskInfo(Task $task, int $developerEfficiency, int $remainingTaskNormalizedDuration, int $usedNormalizedDuration)
    {
        $reelDuration = $usedNormalizedDuration / $task->getDifficult();
        $reelRemainingDuration = $remainingTaskNormalizedDuration / $task->getDifficult();

        $weekTask = new WeekTaskInfo();
        $weekTask->setId($task->getId());
        $weekTask->setName($task->getName());
        $weekTask->setDifficult($task->getDifficult());
        $weekTask->setDuration($task->getDuration());
        $weekTask->setRemeanigDuration($reelRemainingDuration - $reelDuration);
        $weekTask->setReservedDuration($reelDuration);
        $weekTask->setNormalizedDuration($task->getNormalizedDuration());
        $weekTask->setRemeanigNormalizedDuration($remainingTaskNormalizedDuration - $usedNormalizedDuration);
        $weekTask->setReservedNormalizedDuration($usedNormalizedDuration);

        return $weekTask;
    }
}