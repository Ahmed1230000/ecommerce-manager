<?php

namespace App\Domains\User\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('app/Domains/User/Routes/api.php'));

        Route::middleware('web')
            ->group(base_path('app/Domains/User/Routes/web.php'));
    }
}
