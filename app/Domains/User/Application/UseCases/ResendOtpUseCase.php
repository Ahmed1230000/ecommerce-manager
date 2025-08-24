<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Models\User;
use App\Domains\User\Events\ResendOtpEvent;
use App\Domains\User\ValueObjects\IpAddress;

class ResendOtpUseCase
{
    public function execute(IpAddress $ipAddress, string $verificationToken): void
    {
        
        $user = User::where('verification_token', $verificationToken)
            ->where('ip_address', $ipAddress->ip)
            ->where('verify_otp', false)->firstOrFail();


        event(new ResendOtpEvent($user));
    }
}
