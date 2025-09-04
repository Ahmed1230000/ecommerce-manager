<?php

namespace App\Domains\User\Application\UseCases\Role;

use App\Domains\User\Infrastructure\Repositories\RoleRepository;

class ListRolesUseCase
{
    public function __construct(private RoleRepository $roleRepository) {}

    public function execute()
    {
        return $this->roleRepository->index();
    }
}
