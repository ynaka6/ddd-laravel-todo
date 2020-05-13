<?php

declare(strict_types=1);

namespace Package\Task\Application\Interactor;

use Package\Task\Application\InputData\GetUserTasksInputData;
use Package\Task\Application\OutputData\GetListOutputData;
use Package\Task\Application\OutputData\Task as TaskDto;
use Package\Task\Application\OutputData\TaskList as TaskListDto;
use Package\Task\Application\UseCase\GetUserTasksUseCase;
use Package\Task\Domain\Entity\TaskList;
use Package\Task\Domain\Repository\TaskListRepository;
use Package\Task\Domain\Repository\TaskRepository;
use Package\Task\Domain\ValueObject\TaskList\TaskListName;

class GetUserTasksInteractor implements GetUserTasksUseCase
{
    private const DEFAULT_TASK_NAME = 'My Tasks';

    private const DEFAULT_TASK_SELECTED = true;

    private $taskListRepository;

    private $taskRepository;

    public function __construct(
        TaskListRepository $taskListRepository,
        TaskRepository $taskRepository
    ) {
        $this->taskListRepository = $taskListRepository;
        $this->taskRepository = $taskRepository;
    }

    public function handle(GetUserTasksInputData $inputData): GetListOutputData
    {
        $taskList = $this->getTaskListByUserId($inputData->userId());
        $selectedTaskList = array_filter($taskList, function ($list) {
            return $list->isSelected();
        })[0];

        $taskList = array_map(function ($entity) {
            return new TaskListDto(
                $entity->id(),
                $entity->name()->value(),
                $entity->isSelected(),
            );
        }, $taskList);

        $tasks = array_map(function ($entity) {
            return new TaskDto(
                $entity->id(),
                $entity->title()->value(),
                $entity->detail() ? $entity->detail()->value() : null,
                $entity->isComplete(),
                $entity->dueDatetime() ? $entity->dueDatetime()->value()->format('Y-m-d') : null
            );
        }, $this->taskRepository->findByUserIdAndListId($inputData->userId(), $selectedTaskList->id()));
        return new GetListOutputData($taskList, $tasks);
    }

    protected function getTaskListByUserId(int $userId): array
    {
        $taskList = $this->taskListRepository->findByUserId($userId);

        if (empty($taskList)) {
            $taskList[] = $this->taskListRepository->createTaskList(TaskList::new(
                $userId,
                new TaskListName(self::DEFAULT_TASK_NAME),
                self::DEFAULT_TASK_SELECTED
            ));
        }
        return $taskList;
    }
}
