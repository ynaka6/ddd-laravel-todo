<?php

declare(strict_types=1);

namespace Package\Task\Application\UseCase;

use Package\Task\Application\InputData\ChangeStateInputData;

interface ChangeStateTaskUseCase
{
    public function handle(ChangeStateInputData $inputData): void;
}
