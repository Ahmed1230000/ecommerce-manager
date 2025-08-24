<?php

namespace App\Domains\User\Application\DTOs;

use App\Domains\User\ValueObjects\EmailValueObject;

class VerifyOtpForUserDTO
{
    public function __construct(
        public EmailValueObject $email,
        public string $otp
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->email,
            'otp' => $this->otp
        ];
    }
}
