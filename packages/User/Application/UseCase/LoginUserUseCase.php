<?php

declare(strict_types=1);

namespace Package\User\Application\UseCase;

use Package\User\Application\InputData\LoginUserInputData;
use Package\User\Application\OutputData\LoginUserOutputData;

interface LoginUserUseCase
{
    public function handle(LoginUserInputData $inputData): LoginUserOutputData;
}
