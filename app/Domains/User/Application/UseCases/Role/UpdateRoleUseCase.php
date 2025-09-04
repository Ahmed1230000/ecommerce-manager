<?php

namespace App\Domains\User\Application\UseCases\Role;

use App\Domains\User\Application\DTOs\CreateRoleDTO;
use App\Domains\User\Infrastructure\Repositories\RoleRepository;

class UpdateRoleUseCase
{
    public function __construct(private RoleRepository $roleRepository) {}

    public function execute(int $id, CreateRoleDTO $dto)
    {
        $role = $this->roleRepository->update($id, $dto->toArray());
        return $role;
    }
}
