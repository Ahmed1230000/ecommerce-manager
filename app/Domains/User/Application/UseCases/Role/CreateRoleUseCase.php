<?php

namespace App\Domains\User\Application\UseCases\Role;

use App\Domains\User\Application\DTOs\CreateRoleDTO;
use App\Domains\User\Infrastructure\Repositories\RoleRepository;

class CreateRoleUseCase
{
    public function __construct(private RoleRepository $roleRepository) {}

    public function execute(CreateRoleDTO $dto)
    {
        $role = $this->roleRepository->store($dto->toArray());
        return $role;
    }
}
