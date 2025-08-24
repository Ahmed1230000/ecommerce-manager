<?php

namespace App\Domains\User\Application\UseCases;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;

class GetMyProfileUseCase
{
    public function execute(): User
    {
        if (!Auth::check()) {
            abort(401);
        }
        return Auth::user();
    }
}
