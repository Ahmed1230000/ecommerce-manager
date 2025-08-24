<?php

namespace Database\Seeders;

use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Roles & Permissions definition
     */
    public $roles = [
        'admin',
        'user',
    ];

    public $permissions = [
        'user',
    ];

    public $actions = [
        'index',
        'create',
        'show',
        'update',
        'delete',
    ];

    public function run(): void
    {
        // clear cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createRole();
        $this->createPermission();
        $this->roleHasPermission();
        $this->assignAdminRoleToFirstUser();
        $this->assignAllPermissionsToFirstUser();
    }

    private function createRole()
    {
        foreach ($this->roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'api',
            ]);
        }
    }

    private function createPermission()
    {
        foreach ($this->permissions as $permission) {
            foreach ($this->actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$permission}-{$action}",
                    'guard_name' => 'api',
                ]);
            }
        }
    }

    private function roleHasPermission()
    {
        foreach ($this->roles as $roleName) {
            $role = Role::findByName($roleName, 'api');

            foreach ($this->permissions as $permissionName) {
                foreach ($this->actions as $action) {
                    $permission = Permission::findByName("{$permissionName}-{$action}", 'api');
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
    private function assignAllPermissionsToFirstUser()
    {
        $user = User::find(1);
        if ($user) {
            foreach ($this->permissions as $permissionName) {
                foreach ($this->actions as $action) {
                    $permission = Permission::findByName("{$permissionName}-{$action}", 'api');
                    $user->givePermissionTo($permission);
                }
            }
        }
    }

    private function assignAdminRoleToFirstUser()
    {
        $user = User::find(1);
        if ($user) {
            $role = Role::findByName('admin', 'api');
            $user->assignRole($role);
        }
    }
}
