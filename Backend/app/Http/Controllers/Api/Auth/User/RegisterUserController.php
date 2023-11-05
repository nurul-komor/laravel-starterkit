<?php
// need
namespace App\Http\Controllers\Api\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    // User Registration
    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->validated() + ['password' => Hash::make($request->password)]);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Registration Successful',
                'user' => $user,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'message' => 'Opps! something went wrong. Please try again.',
            'user' => $user,
        ], 500);

    }
}