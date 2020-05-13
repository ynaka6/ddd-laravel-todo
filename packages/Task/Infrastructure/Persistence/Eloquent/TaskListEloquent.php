<?php

declare(strict_types=1);

namespace Package\Task\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Package\Task\Domain\Entity\TaskList;
use Package\Task\Domain\Repository\TaskListRepository;
use Package\Task\Domain\ValueObject\TaskList\TaskListName;

class TaskListEloquent extends Model implements TaskListRepository
{
    protected $table = 'task_lists';

    public function findById(int $id): TaskList
    {
        $eloquent = $this->find($id);

        if (empty($eloquent)) {
            throw new \Exception();
        }
        return TaskList::set(
            $eloquent->id,
            $eloquent->user_id,
            new TaskListName($eloquent->name),
            $eloquent->is_selected ? true : false,
            $eloquent->created_at->toImmutable(),
            $eloquent->updated_at->toImmutable()
        );
    }

    public function findByUserId(int $userId): array
    {
        return $this
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get()
            ->transform(function ($eloquent) {
                return TaskList::set(
                    $eloquent->id,
                    $eloquent->user_id,
                    new TaskListName($eloquent->name),
                    $eloquent->is_selected ? true : false,
                    $eloquent->created_at->toImmutable(),
                    $eloquent->updated_at->toImmutable()
                );
            })
            ->toArray();
    }

    public function createTaskList(TaskList $taskList): TaskList
    {
        $this
            ->forceFill([
                'user_id' => $taskList->userId(),
                'name' => $taskList->name()->value(),
                'is_selected' => $taskList->isSelected(),
            ])
            ->save();
        return TaskList::set(
            $this->id,
            $taskList->userId(),
            $taskList->name(),
            $taskList->isSelected(),
            $this->created_at->toImmutable(),
            $this->updated_at->toImmutable()
        );
    }

    public function updateTaskList(TaskList $taskList): int
    {
        if (empty($taskList->id())) {
            throw new \Exception();
        }

        if (empty($taskList->userId())) {
            throw new \Exception();
        }

        $attributes = [];

        if ($taskList->name()) {
            $attributes['name'] = $taskList->name()->value();
        }

        return $this
            ->where([
                'id' => $task->id(),
                'user_id' => $task->userId(),
            ])
            ->update($attributes);
    }
}
