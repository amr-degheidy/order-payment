<?php

namespace App\Services\User;

interface AuthenticationServiceInterface
{
    /**
     * @param array{email:string,  password:string} $data
     */
    public function authenticateUserByCredentials(array $data): false|string;
}
