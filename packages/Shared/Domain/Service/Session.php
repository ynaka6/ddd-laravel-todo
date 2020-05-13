<?php

declare(strict_types=1);

namespace Package\Shared\Domain\Service;

interface Session
{
    public function flash(string $name, string $message): void;
}
