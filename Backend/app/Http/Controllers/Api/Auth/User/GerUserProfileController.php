<?php

namespace App\Http\Controllers\Api\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class GerUserProfileController extends Controller
{
    // user Profile
    public function profile()
    {
        $user = auth()->user();
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }
}