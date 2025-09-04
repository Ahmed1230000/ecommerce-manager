<?php

namespace App\Domains\User\ValueObjects;

class NameValueObject
{
    public function __construct(private string $name)
    {
        $name = trim(strtolower($name));
        if (strlen($name) === 0) {
            throw new \InvalidArgumentException('Role name cannot be empty');
        }
        $this->name = $name;
    }


    public function getName(): string
    {
        return $this->name;
    }
}
