<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Application\DTOs\RegisterDTO;
use App\Domains\User\Contract\UserRepositoryInterface;
use App\Domains\User\Events\UserRegisteredEvent;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(RegisterDTO $dto)
    {
        $data = $dto->toArray();
        $data['password'] = bcrypt($dto->password);
        $data['ip_address'] = request()->ip();
        $data['verification_token'] = bin2hex(random_bytes(30));
        $user = $this->userRepository->create($data);
        event(new UserRegisteredEvent($user));
        return $user;
    }
}
