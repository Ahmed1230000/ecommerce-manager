<?php

namespace App\Domains\User\ValueObjects;

use InvalidArgumentException;

class PasswordValueObject
{
    private string $value;

    public function __construct(string $password)
    {
        $this->ensureIsValid($password);
        $this->value = $password;
    }

    private function ensureIsValid(string $password): void
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters.');
        }

        if (!preg_match('/[A-Z]/', $password)) {
            throw new InvalidArgumentException('Password must contain at least one uppercase letter.');
        }

        if (!preg_match('/[a-z]/', $password)) {
            throw new InvalidArgumentException('Password must contain at least one lowercase letter.');
        }

        if (!preg_match('/[0-9]/', $password)) {
            throw new InvalidArgumentException('Password must contain at least one digit.');
        }

        if (!preg_match('/[\W]/', $password)) {
            throw new InvalidArgumentException('Password must contain at least one special character.');
        }
    }
    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
