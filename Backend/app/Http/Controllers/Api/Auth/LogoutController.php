<?php
// need
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;
use GuzzleHttp\Psr7\Request;

class LogoutController extends Controller
{
    // User logout
    public function logout(LogoutRequest $request)
    {
        return $request->user();
        auth()->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ], 200);
    }
}