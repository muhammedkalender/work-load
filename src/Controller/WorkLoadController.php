<?php

namespace App\Controller;

use App\Service\TaskDistributionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkLoadController extends Controller
{
    private $taskDistributionService;

    /**
     * @param TaskDistributionServiceInterface $taskDistributionService
     */
    public function __construct(TaskDistributionServiceInterface $taskDistributionService)
    {
        $this->taskDistributionService = $taskDistributionService;
    }

    /**
     * @Route("/")
     */
    public function workload(): Response
    {
        return $this->render('work-load/index.html.twig', [
                'weeklyData' => $this->taskDistributionService->weeklyGroup($this->taskDistributionService->calculateWorkloadWithDefaultParameters())
            ]
        );
    }
}