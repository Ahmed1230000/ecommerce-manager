<?php

namespace App\Domains\User\Contract;

use App\Domains\User\Application\DTOs\LoginDTO;
use App\Domains\User\Application\DTOs\RegisterDTO;
use App\Domains\User\Models\User;

interface AuthServiceInterface
{
    public function register(RegisterDTO $dto);

    public function login(LoginDTO $dto): array;

    public function logout(): void;
}
