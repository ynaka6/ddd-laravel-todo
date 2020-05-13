<?php

declare(strict_types=1);

namespace Package\Task\Application\InputData;

class GetUserTasksInputData
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}
