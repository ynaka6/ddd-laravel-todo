<?php

declare(strict_types=1);

namespace Package\Shared\Infrastructure\Laravel;

use Package\Shared\Domain\Service\Session as SessionService;

class Session implements SessionService
{
    public function flash(string $name, string $message): void
    {
        session()->flash($name, $message);
    }
}
