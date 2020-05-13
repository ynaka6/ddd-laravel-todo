<?php

declare(strict_types=1);

namespace Package\Task\Application\OutputData;

class TaskList
{
    private $id;

    private $name;

    private $isSelected = false;

    public function __construct(
        int $id,
        string $name,
        bool $isSelected
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->isSelected = $isSelected;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function isSelected(): bool
    {
        return $this->isSelected;
    }

    public function isSelectedStr(): string
    {
        return $this->isSelected ? 'true' : 'false';
    }
}
