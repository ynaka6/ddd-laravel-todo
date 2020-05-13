<?php

declare(strict_types=1);

namespace Package\User\Application\UseCase;

use Package\User\Application\OutputData\GetLoginUserOutputData;

interface GetLoginUserUseCase
{
    public function handle(): GetLoginUserOutputData;
}
