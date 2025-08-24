<?php

namespace App\Domains\User\Application\UseCases;

use Illuminate\Support\Facades\Auth;

class LogoutUseCase
{
    public function execute()
    {
        $user = Auth::user();
        if ($user) {
            $user->token()->delete();
        }
    }
}
