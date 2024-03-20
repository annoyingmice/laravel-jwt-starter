<?php

namespace App\Services\API;

use App\Dto\API\UserCreateDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{

    public function __initializeUser()
    {
    }

    public function users(?int $limit = 20): mixed
    {
        $users = User::paginate($limit);
        return $users;
    }

    public function userCreate(UserCreateDto $dto): User
    {
        $user = new User();
        $user->first_name = $dto->first_name;
        $user->middle_name = $dto->middle_name;
        $user->last_name = $dto->last_name;
        $user->email = $dto->email;
        $user->phone = $dto->phone;
        $user->address = $dto->address;
        
        if(!is_null($dto->password)) 
        {
            $user->password = Hash::make($dto->password);
        }

        $user->save();
        return $user;
    }

    public function userShow(User $user): User
    {
        return $user;
    }

    public function userUpdate(UserCreateDto $dto, User $user): User
    {
        $user->first_name = $dto->first_name;
        $user->middle_name = $dto->middle_name;
        $user->last_name = $dto->last_name;
        $user->email = $dto->email;
        $user->phone = $dto->phone;
        $user->address = $dto->address;
        $user->save();
        return $user;
    }

    public function userDelete(User $user): User
    {
        $user->delete();
        return $user;
    }
}
