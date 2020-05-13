<?php

declare(strict_types=1);

namespace Package\Task\Domain\Repository;

use Package\Task\Domain\Entity\Task;

interface TaskRepository
{
    public function findById(int $id): Task;

    public function findByUserIdAndListId(int $userId, int $listId): array;

    public function create(Task $task): Task;

    public function updateTask(Task $task): int;
}
