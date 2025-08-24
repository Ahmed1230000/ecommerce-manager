<?php

namespace App\Domains\User\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Common\Traits\HandleResponseAndLog;
use App\Domains\User\Application\DTOs\VerifyOtpForUserDTO;
use App\Domains\User\Application\UseCases\ResendOtpUseCase;
use App\Domains\User\Application\UseCases\VerifyOtpForUserUseCase;
use App\Domains\User\Http\Requests\VerifyOtpForUserFormRequest;
use App\Common\Traits\HandlesResendOtp;
use App\Domains\User\ValueObjects\EmailValueObject;
use Illuminate\Http\Request;
use Throwable;

class VerifyOtpForUserController extends Controller
{
    use HandleResponseAndLog, HandlesResendOtp;

    public function __construct(
        public VerifyOtpForUserUseCase $useCase,
        public ResendOtpUseCase $resendOtpUseCase
    ) {}

    public function verify(VerifyOtpForUserFormRequest $request)
    {
        try {
            $dto = new VerifyOtpForUserDTO(
                email: new EmailValueObject($request->validated()['email']),
                otp: $request->validated()['otp']
            );

            $this->useCase->execute($dto);

            return $this->successResponse(null, 'OTP verified successfully', 200);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to verify OTP', 422, $e, 'VerifyOtp');
        }
    }

    public function resend(Request $request)
    {
        try {
            return $this->handleResendOtp($request, $this->resendOtpUseCase);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to resend OTP', 422, $e, 'ResendOtp');
        }
    }
}
