<?php

namespace App\Services\API;

use App\Dto\API\RolePermissionCreateDto;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait RolePermissionTrait
{

    public function __initializeRolePermission()
    {
    }

    public function assignPermission(RolePermissionCreateDto $dto): Role
    {
        $role = Role::find($dto->role_id);
        if (!$role) {
            throw new ModelNotFoundException('Role not found');
        }
        $role->permissions()->sync($dto->permissions);
        $role->load('permissions');
        return $role;
    }
}
