<?php

namespace App\Domains\User\Application\DTOs;

use App\Domains\User\ValueObjects\NameValueObject;

class CreatePermissionDTO
{
    public function __construct(
        public NameValueObject $name,
        public string $guardName = 'api',
    ) {}

    public function toArray(): array
    {
        return [
            'name'       => $this->name->getName(),
            'guard_name' => $this->guardName,
        ];
    }
}
