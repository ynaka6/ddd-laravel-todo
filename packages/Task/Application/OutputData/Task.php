<?php

declare(strict_types=1);

namespace Package\Task\Application\OutputData;

class Task
{
    private $id;

    private $title;

    private $detail;

    private $isComplete = false;

    private $dueDatetime;

    public function __construct(
        int $id,
        string $title,
        ?string $detail,
        bool $isComplete,
        ?string $dueDatetime
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->detail = $detail;
        $this->isComplete = $isComplete;
        $this->dueDatetime = $dueDatetime;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function detail(): ?string
    {
        return $this->detail;
    }

    public function isComplete(): bool
    {
        return $this->isComplete;
    }

    public function isCompleteStr(): string
    {
        return $this->isComplete ? 'true' : 'false';
    }

    public function dueDatetime(): ?string
    {
        return $this->dueDatetime;
    }
}
