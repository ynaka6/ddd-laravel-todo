<?php

declare(strict_types=1);

namespace Package\Task\Application\Interactor;

use Package\Task\Application\InputData\CreateTaskInputData;
use Package\Task\Application\UseCase\CreateTaskUseCase;
use Package\Task\Domain\Entity\Task;
use Package\Task\Domain\Repository\TaskRepository;
use Package\Task\Domain\ValueObject\Task\TaskDetail;
use Package\Task\Domain\ValueObject\Task\TaskTitle;

class CreateTaskInteractor implements CreateTaskUseCase
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateTaskInputData $inputData): void
    {
        $this->repository->create(
            Task::new(
                $inputData->userId(),
                $inputData->listId(),
                new TaskTitle($inputData->title()),
                $inputData->detail() ? new TaskDetail($inputData->detail()) : null,
                null
            )
        );
    }
}
