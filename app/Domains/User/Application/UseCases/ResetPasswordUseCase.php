<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Application\DTOs\ResetPasswordDTO;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Password;

class ResetPasswordUseCase
{
    public function execute(ResetPasswordDTO $dto): string
    {
        $status = Password::reset(
            [
                'email' => $dto->email,
                'token' => $dto->token,
                'password' => $dto->newPassword,
                'password_confirmation' => $dto->password_confirmation ?? $dto->newPassword,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status;
    }
}
