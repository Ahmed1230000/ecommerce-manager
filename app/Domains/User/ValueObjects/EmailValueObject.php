<?php

namespace App\Domains\User\ValueObjects;

use Illuminate\Validation\Rules\Email;
use InvalidArgumentException;

class EmailValueObject
{
    public readonly string $value;
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format: {$email}");
        }

        $this->value = strtolower(trim($email));
    }

    public function equals(EmailValueObject $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
