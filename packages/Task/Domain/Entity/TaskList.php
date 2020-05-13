<?php

declare(strict_types=1);

namespace Package\Task\Domain\Entity;

use Carbon\CarbonImmutable;
use Package\Shared\Domain\Entity\Entity;
use Package\Task\Domain\ValueObject\TaskList\TaskListName;

class TaskList extends Entity
{
    protected $userId;

    protected $name;

    protected $isSelected = false;

    public function userId(): int
    {
        return $this->userId;
    }

    public function name(): TaskListName
    {
        return $this->name;
    }

    public function isSelected(): bool
    {
        return $this->isSelected;
    }

    /**
     * 新規登録に利用する.
     * @param int              $userId
     * @param TaskListName         $name
     */
    public static function new(int $userId, TaskListName $name, bool $isSelected)
    {
        $entity = new self();
        $entity->fill(compact('userId', 'name', 'isSelected'));
        return $entity;
    }

    /**
     * 検索した結果を登録する際に利用する.
     * @param int              $id
     * @param int              $userId
     * @param TaskListName         $name
     * @param bool         $isSelected
     * @param ?CarbonImmutable $createdAt
     * @param ?CarbonImmutable $updatedAt
     */
    public static function set(int $id, int $userId, TaskListName $name, bool $isSelected, ?CarbonImmutable $createdAt, ?CarbonImmutable $updatedAt)
    {
        $entity = new self();
        $entity->fill(compact('id', 'userId', 'name', 'isSelected', 'createdAt', 'updatedAt'));
        return $entity;
    }
}
