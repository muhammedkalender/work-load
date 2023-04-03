<?php

namespace App\Command;

use App\Model\ProviderError;
use App\Provider\TaskProviderFactory;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchTasksCommand extends Command
{
    private $taskProviderFactory;
    private $entityManager;

    public function __construct(TaskProviderFactory $taskProviderFactory, EntityManagerInterface $entityManager)
    {
        $this->taskProviderFactory = $taskProviderFactory;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:fetch-tasks')
            ->setDescription('Fetch tasks from external providers')
            ->setHelp('This command fetch users from registered providers');
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $providers = ['it', 'business'];

        $output->writeln("Task migration started");

        foreach ($providers as $providerName) {
            $taskProvider = $this->taskProviderFactory->create($providerName);
            $tasks = $taskProvider->fetchTasks();


            $output->writeln("$providerName provider called!");

            if ($tasks instanceof ProviderError) {
                $output->writeln("Caught error : " . $tasks->getMessage());
            } else {
                $output->writeln("Successfully received task list, count : " . count($tasks));

                foreach ($tasks as $task) {
                    $this->entityManager->persist($task);
                }

                $this->entityManager->flush();

                $output->writeln("Tasks successfully saved to db");
            }
        }

        $output->writeln("Task migration finished");

        return 0;
    }
}