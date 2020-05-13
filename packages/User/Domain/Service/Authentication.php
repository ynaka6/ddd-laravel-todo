<?php

declare(strict_types=1);

namespace Package\User\Domain\Service;

use Package\User\Domain\Entity\User;

interface Authentication
{
    public function getLoginId(): int;

    public function login(User $user): void;

    public function logout(): void;
}
