<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Application\DTOs\LoginDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class LoginUseCase
{
    public function execute(LoginDTO $dto)
    {
        $data = $dto->toArray();

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw new AuthenticationException('Invalid credentials.');
        }

        $user = Auth::user();


        if (!$user->verifiedOtp()) {
            throw new AuthenticationException('OTP not verified.');
        }

        $token = $user->createToken('auth_token')->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
