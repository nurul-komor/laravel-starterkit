<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class TokenGeneratorController extends Controller
{
    public function generateToken($guard): array
    {
        $data = auth($guard)->user();
        $token = auth()->guard($guard)->claims(['data' => $data])->attempt(request(['email', 'password']));
        $token_array = new ResponseTokenController;

        return $token_array->respondWithToken($token);
    }
}