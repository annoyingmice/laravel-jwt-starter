<?php

namespace App\Http\Controllers\Api\v1;

use App\Dto\Auth as AuthDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Services\Base;
use Exception;

class AuthController extends Controller
{
    private $service;

    public function __construct(Base $service)
    {
        $this->service = $service;
    }

    /**
     * User's login
     * @param LoginRequest $request
     * @return mixed
     */
    public function user(LoginRequest $request): mixed
    {
        try {
            return $this->service->loginUser(
                AuthDto::fromRequest($request),
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Admin's login
     */
    public function admin(LoginRequest $request)
    {
        try {
            return $this->service->loginAdmin(
                AuthDto::fromRequest($request),
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
