<?php

declare(strict_types=1);

namespace Package\User\Application\InputData;

class LoginUserInputData
{
    private $email;

    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function rawPassword(): string
    {
        return $this->password;
    }
}
