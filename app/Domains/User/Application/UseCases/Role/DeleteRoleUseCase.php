<?php

namespace App\Domains\User\Application\UseCases\Role;

use App\Domains\User\Infrastructure\Repositories\RoleRepository;

class DeleteRoleUseCase
{
    public function __construct(private RoleRepository $roleRepository) {}

    public function execute(int $id)
    {
        return $this->roleRepository->destroy($id);
    }
}
