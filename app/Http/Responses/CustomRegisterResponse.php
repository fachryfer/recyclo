<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class CustomRegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Asumsikan user baru pasti role-nya user
        return redirect()->route('user.dashboard');
    }
}
