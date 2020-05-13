<?php

declare(strict_types=1);

namespace Package\User\Domain\Repository;

use Package\Shared\Domain\ValueObject\Email;
use Package\User\Domain\Entity\User;

interface UserRepository
{
    public function findById(int $id): ?User;

    public function findByEmail(Email $email): ?User;

    public function create(User $user): User;
}
