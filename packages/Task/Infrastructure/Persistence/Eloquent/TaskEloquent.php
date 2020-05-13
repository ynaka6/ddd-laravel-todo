<?php

declare(strict_types=1);

namespace Package\Task\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Package\Task\Domain\Entity\Task;
use Package\Task\Domain\Repository\TaskRepository;
use Package\Task\Domain\ValueObject\Task\TaskDetail;
use Package\Task\Domain\ValueObject\Task\TaskTitle;

class TaskEloquent extends Model implements TaskRepository
{
    protected $table = 'tasks';

    protected $dates = [
        'due_datetime',
    ];

    public function findById(int $id): Task
    {
        $eloquent = $this->find($id);

        if (empty($eloquent)) {
            throw new \Exception();
        }
        return Task::set(
            $eloquent->id,
            $eloquent->user_id,
            $eloquent->task_list_id,
            new TaskTitle($eloquent->title),
            $eloquent->detail ? new TaskDetail($eloquent->detail) : null,
            $eloquent->due_datetime ? $eloquent->due_datetime->toImmutable() : null,
            $eloquent->is_complete ? true : false,
            $eloquent->created_at->toImmutable(),
            $eloquent->updated_at->toImmutable()
        );
    }

    public function findByUserIdAndListId(int $userId, int $listId): array
    {
        return $this
            ->where('user_id', $userId)
            ->where('task_list_id', $listId)
            ->orderBy('id', 'desc')
            ->get()
            ->transform(function ($eloquent) {
                return Task::set(
                    $eloquent->id,
                    $eloquent->user_id,
                    $eloquent->task_list_id,
                    new TaskTitle($eloquent->title),
                    $eloquent->detail ? new TaskDetail($eloquent->detail) : null,
                    $eloquent->due_datetime ? $eloquent->due_datetime->toImmutable() : null,
                    $eloquent->is_complete ? true : false,
                    $eloquent->created_at->toImmutable(),
                    $eloquent->updated_at->toImmutable()
                );
            })
            ->toArray();
    }

    public function create(Task $task): Task
    {
        $this
            ->forceFill([
                'user_id' => $task->userId(),
                'task_list_id' => $task->listId(),
                'title' => $task->title()->value(),
                'detail' => optional($task->detail())->value(),
                'due_datetime' => optional($task->dueDatetime())->value(),
                'is_complete' => $task->isComplete(),
            ])
            ->save();
        return Task::set(
            $this->id,
            $task->userId(),
            $task->listId(),
            $task->title(),
            $task->detail(),
            $task->dueDatetime(),
            $task->isComplete(),
            $this->created_at->toImmutable(),
            $this->updated_at->toImmutable()
        );
    }

    public function updateTask(Task $task): int
    {
        if (empty($task->id())) {
            throw new \Exception();
        }
        if (empty($task->userId())) {
            throw new \Exception();
        }
        if (empty($task->listId())) {
            throw new \Exception();
        }

        $attributes = [];

        if ($task->title()) {
            $attributes['title'] = $task->title()->value();
        }

        if ($task->detail()) {
            $attributes['detail'] = $task->detail()->value();
        }

        if ($task->isComplete() !== null) {
            $attributes['is_complete'] = $task->isComplete();
        }

        if ($task->dueDatetime()) {
            $attributes['due_datetime'] = $task->dueDatetime();
        }

        return $this
            ->where([
                'id' => $task->id(),
                'user_id' => $task->userId(),
                'task_list_id' => $task->listId(),
            ])
            ->update($attributes);
    }
}
