<?php

declare(strict_types=1);

namespace Package\Task\Application\UseCase;

use Package\Task\Application\InputData\CreateTaskInputData;

interface CreateTaskUseCase
{
    public function handle(CreateTaskInputData $inputData): void;
}
