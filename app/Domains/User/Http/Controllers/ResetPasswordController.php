<?php

namespace App\Domains\User\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Common\Traits\HandleResponseAndLog;
use App\Domains\User\Application\DTOs\ResetPasswordDTO;
use App\Domains\User\Application\UseCases\SendResetLinkUseCase;
use App\Domains\User\Application\UseCases\ResetPasswordUseCase;
use App\Domains\User\Http\Requests\ResetPasswordFormRequest;
use App\Domains\User\Http\Requests\SendResetPasswordFormRequest;
use Illuminate\Support\Facades\Password;
use Throwable;

class ResetPasswordController extends Controller
{
    use HandleResponseAndLog;

    public function __construct(
        protected SendResetLinkUseCase $sendResetLinkUseCase,
        protected ResetPasswordUseCase $resetPasswordUseCase
    ) {}

    public function sendResetLink(SendResetPasswordFormRequest $request)
    {
        try {
            $dto = new ResetPasswordDTO([
                'email' => $request->validated()['email'],
                'token' => '',
                'newPassword' => '',
            ]);

            $status = $this->sendResetLinkUseCase->execute($dto);

            if ($status === Password::RESET_LINK_SENT) {
                return $this->successResponse(null, __('Password reset link sent successfully'));
            }

            return $this->errorResponse(__('Unable to send password reset link'), 400);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to send reset link', 500, $e, 'SendResetLink');
        }
    }

    public function resetPassword(ResetPasswordFormRequest $request)
    {
        try {
            $dto = new ResetPasswordDTO([
                'email' => $request->validated()['email'],
                'token' => $request->validated()['token'],
                'newPassword' => $request->validated()['newPassword'],
                'password_confirmation' => $request->validated()['newPassword_confirmation'] ?? null,
            ]);

            $status = $this->resetPasswordUseCase->execute($dto);

            if ($status === Password::PASSWORD_RESET) {
                return $this->successResponse(null, __('Password reset successfully'));
            }

            return $this->errorResponse(__('Failed to reset password'), 400);
        } catch (Throwable $e) {
            return $this->errorResponse('Error occurred while resetting password', 500, $e, 'ResetPassword');
        }
    }
}
