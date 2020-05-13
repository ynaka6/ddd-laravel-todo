<?php

declare(strict_types=1);

namespace Package\User\Infrastructure\Laravel;

use Illuminate\Auth\AuthManager;
use Package\User\Domain\Entity\User;
use Package\User\Domain\Service\Authentication as AuthenticationService;

class Authentication implements AuthenticationService
{
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function getLoginId(): int
    {
        return $this->authManager->guard()->id();
    }

    public function login(User $user): void
    {
        $authUser = \App\User::make();
        $authUser->id = $user->id();
        $authUser->email = $user->email()->value();
        $this->authManager->guard()->login($authUser);
        session()->regenerate();
    }

    public function logout(): void
    {
        $this->authManager->guard()->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
