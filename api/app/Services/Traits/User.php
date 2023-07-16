<?php

namespace App\Services\Traits;

use App\Dto\Auth as AuthDto;
use App\Exceptions\LoginException;
use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Api\v1\AuthResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

trait User
{
    /**
     * Login user's
     * @param AuthDto $dto
     * @return mixed
     */
    public function loginUser(AuthDto $dto): AuthResource
    {
        $user = ModelsUser::where('username', $dto->user)
            ->orWhere('email', $dto->user)
            ->first();

        if (is_null($user)) {
            throw new ModelNotFoundException('User not found', Response::HTTP_NOT_FOUND);
        }

        if (!Hash::check($dto->password, $user->password)) {
            throw new LoginException('Invalid username or password.', Response::HTTP_UNAUTHORIZED);
        }

        return new AuthResource($user);
    }
}
