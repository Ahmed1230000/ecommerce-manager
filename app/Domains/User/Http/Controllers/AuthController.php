<?php

namespace App\Domains\User\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Common\Traits\HandleResponseAndLog;
use App\Domains\User\Application\DTOs\LoginDTO;
use App\Domains\User\Application\DTOs\RegisterDTO;
use App\Domains\User\Application\UseCases\LoginUseCase;
use App\Domains\User\Application\UseCases\LogoutUseCase;
use App\Domains\User\Application\UseCases\RegisterUserUseCase;
use App\Domains\User\Http\Requests\LoginFormRequest;
use App\Domains\User\Http\Requests\RegisterFormRequest;
use App\Domains\User\Http\Resources\UserResource;
use App\Domains\User\ValueObjects\EmailValueObject;
use App\Domains\User\ValueObjects\PasswordValueObject;
use Throwable;

class AuthController extends Controller
{
    use HandleResponseAndLog;

    public function __construct(
        protected RegisterUserUseCase $registerUserUseCase,
        protected LoginUseCase $loginUseCases,
        protected LogoutUseCase $logoutUseCase

    ) {}

    public function register(RegisterFormRequest $request)
    {
        try {
            $dto = new RegisterDTO(
                name: $request->validated()['name'],
                email: new EmailValueObject($request->validated()['email']),
                password: new PasswordValueObject($request->validated()['password'])
            );

            $user = $this->registerUserUseCase->execute($dto);


            return $this->successResponse(
                new UserResource($user),
                'User registered successfully.',
                201
            );
        } catch (Throwable $e) {
            return $this->errorResponse(
                'An error occurred while registering the user. Please try again later.',
                400,
                $e,
                'AuthController::register'
            );
        }
    }

    public function login(LoginFormRequest $request)
    {
        try {
            $dto = new LoginDTO(
                email: new EmailValueObject($request->validated()['email']),
                password: new PasswordValueObject($request->validated()['password'])

            );

            $data = $this->loginUseCases->execute($dto);


            return $this->successResponse([
                'user' => new UserResource($data['user']),
                'token' => $data['token'],
            ], 'Login successful.');
        } catch (Throwable $e) {
            return $this->errorResponse(
                'Unable to login with provided credentials.',
                401,
                $e,
                'AuthController::login'
            );
        }
    }

    public function logout()
    {
        try {
            $this->logoutUseCase->execute();

            return $this->successResponse(null, 'Logout successful.');
        } catch (Throwable $e) {
            return $this->errorResponse(
                'An error occurred while logging out. Please try again.',
                400,
                $e,
                'AuthController::logout'
            );
        }
    }
}
