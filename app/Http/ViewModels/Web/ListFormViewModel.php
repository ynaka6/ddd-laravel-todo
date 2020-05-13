<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Web;

class ListFormViewModel
{
    private $title;

    private $namePlaceholder;

    private $nameValue;

    public function __construct(
        string $title,
        string $namePlaceholder,
        ?string $nameValue = null
    ) {
        $this->title = $title;
        $this->namePlaceholder = $namePlaceholder;
        $this->nameValue = $nameValue;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function namePlaceholder(): string
    {
        return $this->namePlaceholder;
    }

    public function nameValue(): ?string
    {
        return $this->nameValue;
    }
}
