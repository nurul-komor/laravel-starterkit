<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class ResponseTokenController extends Controller
{
    /**
     * Get the token array structure.
     *
     * @param  string  $token
     */
    public function respondWithToken($token, $guard = 'user')
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard($guard)->factory()->getTTL(),
        ];
    }
}