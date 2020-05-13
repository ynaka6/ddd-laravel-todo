<?php

declare(strict_types=1);

namespace Package\User\Application\Interactor;

use Package\User\Application\UseCase\LogoutUserUseCase;
use Package\User\Domain\Service\Authentication;

class LogoutUserInteractor implements LogoutUserUseCase
{
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function handle(): void
    {
        $this->authentication->logout();
    }
}
