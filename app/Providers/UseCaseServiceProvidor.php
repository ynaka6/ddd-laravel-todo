<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvidor extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Package\User\Application\UseCase\RegisterUserUseCase::class,
            \Package\User\Application\Interactor\RegisterUserInteractor::class
        );
        $this->app->bind(
            \Package\User\Application\UseCase\LoginUserUseCase::class,
            \Package\User\Application\Interactor\LoginUserInteractor::class
        );
        $this->app->bind(
            \Package\User\Application\UseCase\LogoutUserUseCase::class,
            \Package\User\Application\Interactor\LogoutUserInteractor::class
        );
        $this->app->bind(
            \Package\User\Application\UseCase\GetLoginUserUseCase::class,
            \Package\User\Application\Interactor\GetLoginUserInteractor::class
        );

        $this->app->bind(
            \Package\Task\Application\UseCase\GetUserTasksUseCase::class,
            \Package\Task\Application\Interactor\GetUserTasksInteractor::class
        );
        $this->app->bind(
            \Package\Task\Application\UseCase\CreateTaskUseCase::class,
            \Package\Task\Application\Interactor\CreateTaskInteractor::class
        );
        $this->app->bind(
            \Package\Task\Application\UseCase\ChangeStateTaskUseCase::class,
            \Package\Task\Application\Interactor\ChangeStateTaskInteractor::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
