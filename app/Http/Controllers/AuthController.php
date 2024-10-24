<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\User\AuthenticationServiceInterface;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthenticationServiceInterface $authenticationService,
    ){
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! $token = $this->authenticationService->authenticateUserByCredentials($request->validated())) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(compact('token'));
    }
}
