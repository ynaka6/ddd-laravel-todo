<?php

declare(strict_types=1);

namespace Package\Shared\Domain\Entity;

use Carbon\CarbonImmutable;

class Entity
{
    protected $id;

    protected $createdAt;

    protected $updatedAt;

    public function id(): int
    {
        return $this->id;
    }

    public function createdAt(): ?CarbonImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?CarbonImmutable
    {
        return $this->updatedAt;
    }

    protected function fill(array $row): void
    {
        foreach ($row as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
