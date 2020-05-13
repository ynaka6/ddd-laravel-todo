<?php

declare(strict_types=1);

namespace Package\Task\Application\UseCase;

use Package\Task\Application\InputData\GetUserTasksInputData;
use Package\Task\Application\OutputData\GetListOutputData;

interface GetUserTasksUseCase
{
    public function handle(GetUserTasksInputData $inputData): GetListOutputData;
}
