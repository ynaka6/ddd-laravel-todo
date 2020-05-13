<?php

declare(strict_types=1);

namespace Package\Task\Domain\Repository;

use Package\Task\Domain\Entity\TaskList;

interface TaskListRepository
{
    public function findById(int $userId): TaskList;

    public function findByUserId(int $userId): array;

    public function createTaskList(TaskList $taskList): TaskList;

    public function updateTaskList(TaskList $taskList): int;
}
