<?php

declare(strict_types=1);

namespace Package\Task\Domain\Entity;

use Carbon\CarbonImmutable;
use Package\Shared\Domain\Entity\Entity;
use Package\Task\Domain\ValueObject\Task\TaskDetail;
use Package\Task\Domain\ValueObject\Task\TaskTitle;

class Task extends Entity
{
    protected $userId;

    protected $listId;

    protected $title;

    protected $detail;

    protected $isComplete = false;

    protected $dueDatetime;

    public function userId(): int
    {
        return $this->userId;
    }

    public function listId(): int
    {
        return $this->listId;
    }

    public function title(): TaskTitle
    {
        return $this->title;
    }

    public function detail(): ?TaskDetail
    {
        return $this->detail;
    }

    public function isComplete(): bool
    {
        return $this->isComplete;
    }

    public function dueDatetime(): ?CarbonImmutable
    {
        return $this->dueDatetime;
    }

    public function complete(): void
    {
        $this->isComplete = true;
    }

    public function rollbackComplete(): void
    {
        $this->isComplete = false;
    }

    /**
     * 新規登録に利用する.
     * @param int              $userId
     * @param int              $listId
     * @param Title            $title
     * @param ?TaskDetail      $detail
     * @param ?CarbonImmutable $dueDatetime
     */
    public static function new(int $userId, int $listId, TaskTitle $title, ?TaskDetail $detail, ?CarbonImmutable $dueDatetime)
    {
        $entity = new self();
        $entity->fill(compact('userId', 'listId', 'title', 'detail', 'dueDatetime'));
        return $entity;
    }

    /**
     * 検索した結果を登録する際に利用する.
     * @param int              $id
     * @param int              $userId
     * @param int              $listId
     * @param TaskTitle        $title
     * @param ?TaskDetail      $detail
     * @param ?CarbonImmutable $dueDatetime
     * @param bool             $isComplete
     * @param ?CarbonImmutable $createdAt
     * @param ?CarbonImmutable $updatedAt
     */
    public static function set(int $id, int $userId, int $listId, TaskTitle $title, ?TaskDetail $detail, ?CarbonImmutable $dueDatetime, bool $isComplete, ?CarbonImmutable $createdAt, ?CarbonImmutable $updatedAt)
    {
        $entity = new self();
        $entity->fill(compact('id', 'userId', 'listId', 'title', 'detail', 'dueDatetime', 'isComplete', 'createdAt', 'updatedAt'));
        return $entity;
    }
}
