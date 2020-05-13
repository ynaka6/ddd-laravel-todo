<?php

declare(strict_types=1);

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Package\User\Application\UseCase\GetLoginUserUseCase;

class AuthUserComposer
{
    private $usecase;

    public function __construct(GetLoginUserUseCase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function compose(View $view): void
    {
        $outputData = $this->usecase->handle();
        $view->with('loginUser', $outputData->loginUser());
    }
}
