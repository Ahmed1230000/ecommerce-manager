<?php

namespace App\Domains\User\Application\Services;

use App\Domains\User\Application\DTOs\LoginDTO;
use App\Domains\User\Application\DTOs\RegisterDTO;
use App\Domains\User\Application\UseCases\LoginUseCase;
use App\Domains\User\Application\UseCases\LogoutUseCase;
use App\Domains\User\Application\UseCases\RegisterUserUseCase;
use App\Domains\User\Contract\AuthServiceInterface;
use App\Domains\User\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        protected RegisterUserUseCase $registerUserUseCase,
        protected LoginUseCase $loginUseCases,
        protected LogoutUseCase $logoutUseCase
    ) {}
    public function register(RegisterDTO $dto)
    {
        return $this->registerUserUseCase->execute($dto);
    }

    public function login(LoginDTO $dto): array
    {
        return $this->loginUseCases->execute($dto);
    }

    public function logout(): void
    {
        $this->logoutUseCase->execute();
    }
}
