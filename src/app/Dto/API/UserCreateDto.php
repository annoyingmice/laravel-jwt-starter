<?php

namespace App\Dto\API;

use App\Http\Requests\API\UserCreateRequest;

class UserCreateDto
{
    public function __construct(
        readonly string $first_name,
        readonly ?string $middle_name,
        readonly string $last_name,
        readonly string $email,
        readonly string $phone,
        readonly string $address,
        readonly ?string $password
    ) {
    }

    /**
     * Serialize request
     * @param UserCreateRequest $request
     * @return UserCreateDto
     */
    public static function fromRequest(UserCreateRequest $request): UserCreateDto
    {
        return new self(
            first_name: $request->validated('first_name'),
            middle_name: $request->validated('middle_name'),
            last_name: $request->validated('last_name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            address: $request->validated('address'),
            password: $request->validated('password')
        );
    }
}
