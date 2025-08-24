<?php

namespace App\Domains\User\Application\DTOs;

class ResetPasswordDTO
{
    public string $email;
    public string $token;
    public string $newPassword;
    public ?string $password_confirmation;

    public function __construct(array $data)
    {
        $this->email = $data['email'];
        $this->token = $data['token'];
        $this->newPassword = $data['newPassword'];
        $this->password_confirmation = $data['password_confirmation'] ?? null;
    }
}
