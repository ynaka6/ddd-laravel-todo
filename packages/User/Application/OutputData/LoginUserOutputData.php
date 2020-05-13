<?php

declare(strict_types=1);

namespace Package\User\Application\OutputData;

class LoginUserOutputData
{
    private $isSuccessful;

    public function __construct(bool $isSuccessful)
    {
        $this->isSuccessful = $isSuccessful;
    }

    public function isSuccessful(): bool
    {
        return $this->isSuccessful;
    }
}
