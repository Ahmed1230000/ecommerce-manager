<?php

namespace App\Domains\User\ValueObjects;


class IpAddress
{

    public function __construct(public readonly string $ip) {}

    public function equals(string $other): bool
    {
        return $this->ip === $other;
    }
}
