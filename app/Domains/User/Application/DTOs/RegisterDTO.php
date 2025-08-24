<?php

namespace App\Domains\User\Application\DTOs;

use App\Domains\User\ValueObjects\EmailValueObject;
use App\Domains\User\ValueObjects\PasswordValueObject;

class RegisterDTO
{
    public function __construct(
        public string $name,
        public EmailValueObject $email,
        public PasswordValueObject $password
    ) {}

    public function toArray(): array
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ];
    }
}
