<?php

namespace App\Domains\User\Providers;

use App\Domains\User\Application\Listeners\SendOtpListener;
use App\Domains\User\Application\Listeners\SendResetPasswordNotificationListener;
use App\Domains\User\Events\PasswordResetRequested;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::subscribe(SendOtpListener::class);
        Event::listen(
            PasswordResetRequested::class,
            SendResetPasswordNotificationListener::class
        );
    }
}
