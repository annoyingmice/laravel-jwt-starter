<?php

namespace App\Services\API;

use App\Dto\API\UserRoleCreateDto;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait UserRoleTrait
{

    public function __initializeUserRole()
    {
    }

    public function assignRole(UserRoleCreateDto $dto): User
    {
        $user = User::find($dto->user_id);
        if (!$user) {
            throw new ModelNotFoundException('Role not found');
        }
        $user->roles()->sync($dto->roles);
        $user->load('roles');
        return $user;
    }
}
