<?php

namespace App\Domains\User\Events;

use App\Domains\User\Models\User;

class ResendOtpEvent
{
    public function __construct(public User $user) {}
}
