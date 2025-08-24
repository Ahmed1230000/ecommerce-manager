<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Application\DTOs\VerifyOtpForUserDTO;
use App\Domains\User\Models\Otp;
use App\Domains\User\Models\User;

class VerifyOtpForUserUseCase
{
    public function execute(VerifyOtpForUserDTO $dto)
    {
        $user = User::where('email', $dto->email->value)->first();

        $record = Otp::where('user_id', $user->id)
            ->where('otp', $dto->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            throw new \Exception('Invalid or expired OTP');
        }

        $user->update(['verify_otp' => 1]);

        $record->delete();

        return $record;
    }
}
