<?php

namespace App\Common\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Common\Contract\RepositoryInterface',
            'App\Common\Eloquent\BaseRepository'
        );
        $this->app->register(\App\Domains\User\Providers\DomainServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
