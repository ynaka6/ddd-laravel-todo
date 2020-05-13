<?php

declare(strict_types=1);

namespace Package\Task\Application\InputData;

class ChangeStateInputData
{
    private const STATE_COMPLATE = 'complete';

    private const STATE_ROLLBACK_COMPLATE = 'rollback-complete';

    private $id;

    private $userId;

    private $listId;

    private $state;

    public function __construct(int $id, int $userId, int $listId, string $state)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->listId = $listId;
        $this->state = $state;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function listId(): int
    {
        return $this->listId;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function isComplete(): bool
    {
        return $this->state === self::STATE_COMPLATE;
    }
}
