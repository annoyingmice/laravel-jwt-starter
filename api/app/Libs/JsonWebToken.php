<?php

namespace App\Libs;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libs\Seclib;
use UnexpectedValueException;
use stdClass;

class JsonWebToken
{   
    const KEY_TYPE = 'RS256';
    
    /**
     * Generate token
     * @param stdClass|array $credentials
     * @return string
     */
    public static function token(stdClass|array $credentials): string
    {
        $currentTime = time();
        
        $payload = [
            'iss' => env('APP_DOMAIN'),
            'aud' => '*.'.env('APP_DOMAIN'),
            'iat' => $currentTime,
            'exp' => $currentTime + ((60 * 60 /* 1hour */) * 7 /* 7hours */),
            'crd' => $credentials,
        ];
        
        return JWT::encode($payload, Seclib::privateKey(), JsonWebToken::KEY_TYPE);
    }
    
    /**
     * Token credentials
     * @param string $credentials
     * @return stdClass
     */
    public static function credentials(string $token): stdClass|UnexpectedValueException
    {
        try {
            return JWT::decode($token, new Key(Seclib::publicKey(), JsonWebToken::KEY_TYPE));
        }
        catch (UnexpectedValueException $e) 
        {
            return $e;
        }
    }
}