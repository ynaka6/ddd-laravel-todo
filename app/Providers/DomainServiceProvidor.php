<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DomainServiceProvidor extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Domain
        // Repository
        $this->app->bind(
            \Package\User\Domain\Repository\UserRepository::class,
            \Package\User\Infrastructure\Persistence\Eloquent\UserEloquent::class
        );
        $this->app->bind(
            \Package\Task\Domain\Repository\TaskRepository::class,
            \Package\Task\Infrastructure\Persistence\Eloquent\TaskEloquent::class
        );
        $this->app->bind(
            \Package\Task\Domain\Repository\TaskListRepository::class,
            \Package\Task\Infrastructure\Persistence\Eloquent\TaskListEloquent::class
        );
        // Service
        $this->app->bind(
            \Package\User\Domain\Service\Authentication::class,
            \Package\User\Infrastructure\Laravel\Authentication::class
        );
        $this->app->bind(
            \Package\Shared\Domain\Service\Session::class,
            \Package\Shared\Infrastructure\Laravel\Session::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
