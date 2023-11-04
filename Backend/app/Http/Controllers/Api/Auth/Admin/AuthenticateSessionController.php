<?php

namespace App\Http\Controllers\Api\Auth\Admin;

use App\Http\Controllers\Controller;

class AuthenticateSessionController extends Controller
{
    // admin Logout
    public function logout()
    {
        auth('admin')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ]);
    }
}
