<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;

class LogoutController extends Controller
{
    // User logout
    public function logout(LogoutRequest $request)
    {
        auth($request->guard)->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ], 200);
    }
}