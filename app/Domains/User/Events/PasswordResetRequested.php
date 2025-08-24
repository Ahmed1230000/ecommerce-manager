<?php

namespace App\Domains\User\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Domains\User\Models\User;

class PasswordResetRequested
{
    use Dispatchable, SerializesModels;

    public User $user;
    public string $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
}
