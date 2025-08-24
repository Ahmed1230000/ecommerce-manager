<?php

namespace App\Domains\User\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Common\Traits\HandleResponseAndLog;
use App\Domains\User\Application\UseCases\GetMyProfileUseCase;
use App\Domains\User\Http\Resources\UserResource;
use Throwable;

class GetProfileController extends Controller
{
    use HandleResponseAndLog;

    public function __construct(
        private GetMyProfileUseCase $getMyProfileUseCase
    ) {}

    public function show()
    {
        try {
            $user = $this->getMyProfileUseCase->execute();
            return $this->successResponse(new UserResource($user), 'Profile retrieved successfully');
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to retrieve profile', 500, $e, 'GetProfileController@show');
        }
    }
}
