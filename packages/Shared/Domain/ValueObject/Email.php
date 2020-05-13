<?php

declare(strict_types=1);

namespace Package\Shared\Domain\ValueObject;

class Email
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
