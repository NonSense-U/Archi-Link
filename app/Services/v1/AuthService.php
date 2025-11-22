<?php

namespace App\Services\v1;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register(array $payload)
    {
        try {
            DB::beginTransaction();

            $user = User::create($payload['base']);

            $role = $payload['role'];
            $profile = null;

            if ($role === 'mentor') {
                $user->assignRole('mentor');
                $profile = $user->mentorProfile()->create($payload['profile'] ?? []);
            } elseif ($role === 'student') {
                $user->assignRole('student');
                $profile = $user->studentProfile()->create($payload['profile'] ?? []);
            }

            DB::commit();

            return ApiResponse::success('User registered successfully', [
                'user' => $user,
                'profile' => $profile
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::fail('Registration failed', 500, ['error' => $e->getMessage()]);
        }
    }

    public function login(array $payload)
    {
        try {
            $user = null;
            if (isset($payload['email'])) {
                $user = User::where('email', $payload['email'])->first();
            } elseif (isset($payload['username'])) {
                $user = User::where('username', $payload['username'])->first();
            }

            if (!$user || !Hash::check($payload['password'], $user->password)) {
                return ApiResponse::fail('Invalid credentials', 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            return ApiResponse::success('Login successful', [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return ApiResponse::fail('Login failed', 500, ['error' => $e->getMessage()]);
        }
    }


    public function logout(User $user)
    {
        try {
            /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */
            $token = $user->currentAccessToken();
            $token?->delete();

            return ApiResponse::success('Logout successful');
        } catch (\Exception $e) {
            return ApiResponse::fail('Logout failed', 500, ['error' => $e->getMessage()]);
        }
    }
}
