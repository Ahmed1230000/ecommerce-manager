<?php

namespace App\Domains\User\Application\Listeners;

use App\Domains\User\Events\PasswordResetRequested;
use App\Domains\User\Notifications\ResetPasswordNotification;

class SendResetPasswordNotificationListener
{
    public function handle(PasswordResetRequested $event)
    {
        $event->user->notify(new ResetPasswordNotification($event->token));
    }
}
