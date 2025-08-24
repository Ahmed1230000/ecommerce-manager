<?php

namespace App\Domains\User\Notifications;

use App\Domains\User\ValueObjects\EmailValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $name,
        public EmailValueObject $email,
        public $otp
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Our App!')
            ->greeting("Hello {$this->name}! your email is {$this->email->value} and your OTP is {$this->otp}.")
            ->line('Thank you for registering. We’re glad to have you with us.')
            ->action('Visit Site', url('/'))
            ->line('Enjoy your experience!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
