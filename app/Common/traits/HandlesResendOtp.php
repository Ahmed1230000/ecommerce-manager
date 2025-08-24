<?php

namespace App\Common\Traits;

use Illuminate\Http\Request;
use App\Domains\User\Application\UseCases\ResendOtpUseCase;
use App\Domains\User\Models\User;
use App\Domains\User\ValueObjects\IpAddress;

trait HandlesResendOtp
{
    public function handleResendOtp(Request $request, ResendOtpUseCase $resendOtpUseCase)
    {
        try {
            $verificationToken = $request->cookie('verification_token');


            if (!$verificationToken) {
                $user = User::where('ip_address', $request->ip())
                    ->where('verify_otp', false)
                    ->firstOrFail();

                $verificationToken = $user->verification_token;
            }

            $resendOtpUseCase->execute(
                ipAddress: new IpAddress($request->ip()),
                verificationToken: $verificationToken
            );

            $cookie = cookie('verification_token', $verificationToken, 60, '/', null, true, true);

            return response()->json(['message' => 'OTP resent successfully'])
                ->cookie($cookie);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
