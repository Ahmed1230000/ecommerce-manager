<?php

namespace App\Domains\User\Infrastructure\Repositories;

use App\Common\Eloquent\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        parent::__construct(model: $role);
    }
}
