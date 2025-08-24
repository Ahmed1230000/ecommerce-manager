<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Application\DTOs\ResetPasswordDTO;
use App\Domains\User\Events\PasswordResetRequested;
use App\Domains\User\Models\User;
use App\Domains\User\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Password;

class SendResetLinkUseCase
{
    public function execute(ResetPasswordDTO $dto): string
    {
        $user = User::where('email', $dto->email)->first();

        if (!$user) {
            return Password::INVALID_USER;
        }

        $token = Password::createToken($user);

        event(new PasswordResetRequested($user, $token));


        return Password::RESET_LINK_SENT;
    }
}
