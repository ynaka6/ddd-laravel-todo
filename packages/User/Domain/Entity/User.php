<?php

declare(strict_types=1);

namespace Package\User\Domain\Entity;

use Carbon\CarbonImmutable;
use Package\Shared\Domain\Entity\Entity;
use Package\Shared\Domain\ValueObject\Email;

class User extends Entity
{
    protected $email;

    protected $password;

    protected $rememberToken;

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): ?string
    {
        return $this->password;
    }

    public function rememberToken(): ?string
    {
        return $this->rememberToken;
    }

    /**
     * 新規登録に利用する.
     * @param Email   $email
     * @param ?string $password
     * @param ?string $rememberToken
     */
    public static function new(Email $email, ?string $password, ?string $rememberToken = null)
    {
        $entity = new self();
        $entity->fill(compact('email', 'password', 'rememberToken'));
        return $entity;
    }

    /**
     * 検索した結果を登録する際に利用する.
     * @param int              $id
     * @param Email            $email
     * @param ?string          $password
     * @param ?CarbonImmutable $createdAt
     * @param ?CarbonImmutable $updatedAt
     */
    public static function set(int $id, Email $email, ?string $password, ?CarbonImmutable $createdAt, ?CarbonImmutable $updatedAt)
    {
        $entity = new self();
        $entity->fill(compact('id', 'email', 'password', 'createdAt', 'updatedAt'));
        return $entity;
    }
}
