<?php

declare(strict_types=1);

namespace Package\User\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Package\Shared\Domain\ValueObject\Email;
use Package\User\Domain\Entity\User;
use Package\User\Domain\Repository\UserRepository;

class UserEloquent extends Model implements UserRepository
{
    protected $table = 'users';

    protected $dates = [
        'email_verified_at',
    ];

    public function findById(int $id): ?User
    {
        $user = $this->find($id);
        return $user
            ? User::set(
                $user->id,
                new Email($user->email),
                $user->password,
                $user->created_at->toImmutable(),
                $user->updated_at->toImmutable()
            )
            : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $user = $this->where('email', $email->value())->first();
        return $user
            ? User::set(
                $user->id,
                $email,
                $user->password,
                $user->created_at->toImmutable(),
                $user->updated_at->toImmutable()
            )
            : null;
    }

    public function create(User $user): User
    {
        $this
            ->forceFill([
                'email' => $user->email()->value(),
                'password' => $user->password(),
                'remember_token' => $user->rememberToken(),
            ])
            ->save();
        return User::set(
            $this->id,
            $user->email(),
            $this->password,
            $this->created_at->toImmutable(),
            $this->updated_at->toImmutable()
        );
    }
}
