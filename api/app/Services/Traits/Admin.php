<?php

namespace App\Services\Traits;

use App\Dto\Auth as AuthDto;
use App\Exceptions\LoginException;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Api\v1\AuthResource;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

trait Admin
{
    /**
     * Login admin's
     * @param AuthDto $dto
     * @return mixed
     */
    public function loginAdmin(AuthDto $dto): AuthResource
    {
        $user = ModelsAdmin::where('username', $dto->user)
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
