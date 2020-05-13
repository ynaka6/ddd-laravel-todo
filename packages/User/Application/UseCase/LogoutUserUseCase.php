<?php

declare(strict_types=1);

namespace Package\User\Application\UseCase;

interface LogoutUserUseCase
{
    public function handle(): void;
}
