<?php

namespace App\Http\Controllers\AccountCenter;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\v1\AuthService;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request->validated());
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request->user());
    }
}
