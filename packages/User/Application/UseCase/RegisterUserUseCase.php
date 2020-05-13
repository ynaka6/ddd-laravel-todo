<?php

declare(strict_types=1);

namespace Package\User\Application\UseCase;

use Package\User\Application\InputData\RegisterUserInputData;

interface RegisterUserUseCase
{
    public function handle(RegisterUserInputData $inputData): void;
}
