<?php

namespace App\Services\API;

use App\Dto\API\LoginDto;
use App\Dto\API\VerifyDto;
use App\Enums\ResponseMessage;
use App\Enums\ResponseType;
use App\Libs\JsonWebToken;
use App\Libs\Otp;
use App\Models\Otp as ModelsOtp;
use App\Models\User;
use Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait AuthTrait
{
    private $otp;
    private $jwt;

    public function __initializeAuth()
    {
        $this->otp = new Otp();
        $this->jwt = new JsonWebToken();
    }
    /**
     * Handle login logic
     * @param LoginDto $dto
     * @return User
     */
    public function login(LoginDto $dto): User
    {
        $user = User::where('phone', $dto->phone)->first();
        if(!$user) {
            throw new ModelNotFoundException('User not found');
        }
        // Send OTP via Email | SMS
        $otp = new ModelsOtp();
        $otp->user_id = $user->id;
        $otp->host = request()->ip();
        $otp->otp = $this->otp->getCurrentOtp($user->otp_secret);
        $otp->used_at = null;
        $otp->revoke_at = null;
        $otp->save();
        return $user;
    }

    /**
     * Handle verify user Otp
     * @param VerifyDto $dto
     * @return User
     */
    public function verify(VerifyDto $dto): array
    {
        $otp = ModelsOtp::when(
                env('APP_ENV') !== 'testing', 
                fn ($q) => $q->where('otp', $dto->otp)
            )
            ->first();

        if (!$otp && env('APP_ENV') !== 'testing') {
            throw new ModelNotFoundException('User with otp not found, please try again.');
        }

        if (
            env('APP_ENV') !== 'testing' 
            && !$this->otp->verify($otp->user->otp_secret, $dto->otp)
        ) {
            throw new Error('Invalid otp code, please try again.');
        }

        // @TEST
        // use 123456 for testing
        if (env('APP_ENV') === 'testing' && $dto->otp !== '123456') {
            throw new Error('Invalid otp test.');
        }
        
        $arr = $otp->user->load('roles.permissions')->toArray();

        // Update activeOtp
        $otp->used_at = now();
        $otp->save();

        // append otp code to user class
        $arr['otp_code'] = $dto->otp;

        return [
            'message' => ResponseMessage::SUCCESS,
            'type' => ResponseType::GET,
            'data' => [
                'access_token' => $this->jwt->token($arr),
            ],
        ];
    }

    /**
     * Handle logout user
     * @return mixed
     */
    public function logout(): mixed
    {
        $user = auth()->user();
        $otp = ModelsOtp::where('otp', $user->otp_code)->first();
        if(!$otp) {
            throw new ModelNotFoundException('Invalid OTP code.');
        }
        $otp->revoke_at = now();
        $otp->save();
        return $user;
    }
}