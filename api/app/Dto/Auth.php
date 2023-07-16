<?php

namespace App\Dto;

use App\Http\Requests\Api\v1\LoginRequest;

class Auth
{
    public function __construct(
        readonly string $user,
        readonly string $password
    ) {
    }

    /**
     * Transfer request
     * @param LoginRequest $request
     * @return Auth
     */
    public static function fromRequest(LoginRequest $request): Auth
    {
        return new self(
            user: $request->user,
            password: $request->password
        );
    }
}
