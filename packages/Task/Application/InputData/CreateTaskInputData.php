<?php

declare(strict_types=1);

namespace Package\Task\Application\InputData;

class CreateTaskInputData
{
    private $userId;

    private $title;

    private $listId;

    private $detail;

    public function __construct(int $userId, int $listId, string $title, ?string $detail)
    {
        $this->userId = $userId;
        $this->listId = $listId;
        $this->title = $title;
        $this->detail = $detail;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function listId(): int
    {
        return $this->listId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function detail(): ?string
    {
        return $this->detail;
    }
}
