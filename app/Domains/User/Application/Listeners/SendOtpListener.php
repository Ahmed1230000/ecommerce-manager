<?php

namespace App\Domains\User\Application\Listeners;

use App\Domains\User\Events\ResendOtpEvent;
use App\Domains\User\Events\UserRegisteredEvent;
use App\Domains\User\Models\User;
use App\Domains\User\Notifications\SendOtpNotification;
use App\Domains\User\Notifications\WelcomeNotification;
use App\Domains\User\ValueObjects\EmailValueObject;
use Illuminate\Events\Dispatcher;

class SendOtpListener
{

    public function handleUserRegistered(UserRegisteredEvent $event): void
    {
        $otp = $this->sendOtp($event->user);
        $event->user->notify(new WelcomeNotification($event->user->name, new EmailValueObject($event->user->email), $otp));
    }
    public function handleResendOtp(ResendOtpEvent $event): void
    {
        $otp = $this->sendOtp($event->user);
        $event->user->notify(new SendOtpNotification($otp));
    }
    public function sendOtp(User $user): int
    {

        $otp = random_int(100000, 999999);

        $user->otps()->create([
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        return $otp;
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            UserRegisteredEvent::class   => 'handleUserRegistered',
            ResendOtpEvent::class    => 'handleResendOtp',
        ];
    }
}
