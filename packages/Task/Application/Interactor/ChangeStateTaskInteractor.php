<?php

declare(strict_types=1);

namespace Package\Task\Application\Interactor;

use Package\Shared\Domain\Service\Session as SessionService;
use Package\Task\Application\InputData\ChangeStateInputData;
use Package\Task\Application\UseCase\ChangeStateTaskUseCase;
use Package\Task\Domain\Repository\TaskRepository;

class ChangeStateTaskInteractor implements ChangeStateTaskUseCase
{
    private $repository;

    private $session;

    public function __construct(TaskRepository $repository, SessionService $session)
    {
        $this->repository = $repository;
        $this->session = $session;
    }

    public function handle(ChangeStateInputData $inputData): void
    {
        $task = $this->repository->findById($inputData->id());
        $message = null;

        if ($inputData->isComplete()) {
            $task->complete();
            $message = 'Complete a task.';
        } else {
            $task->rollbackComplete();
            $message = 'Uncomplete a task.';
        }
        $this->repository->updateTask($task);

        $this->session->flash('success', $message);
    }
}
