<?php

namespace App\Services\User;

use Tymon\JWTAuth\Facades\JWTAuth;

final class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @param array{email:string,  password:string} $data
     */
    public function authenticateUserByCredentials(array $data) : false|string
    {
        return JWTAuth::attempt($data);
    }
}
