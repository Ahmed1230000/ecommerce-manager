<?php

namespace App\Domains\User\Providers;

use App\Domains\User\Application\Services\AuthService;
use App\Domains\User\Contract\AuthServiceInterface;
use App\Domains\User\Contract\UserRepositoryInterface;
use App\Domains\User\Infrastructure\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}