<?php

namespace App\Domains\User\Application\DTOs;

use App\Domains\User\ValueObjects\EmailValueObject;
use App\Domains\User\ValueObjects\PasswordValueObject;

class LoginDTO
{

    public function __construct(
        public EmailValueObject $email,
        public PasswordValueObject $password
    ) {}



    public function toArray(): array
    {
        return [
            'email'    => (string) $this->email,
            'password' => (string) $this->password,
        ];
    }
}
