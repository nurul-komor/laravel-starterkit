<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        try {
            $credentials = $request->only('email', 'password');

            // authenticating according to guard
            $authenticator = new AuthenticatorController;

            if (!$authenticator->authenticate($credentials, $request->guard)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Credentials not matched to the records!',
                ], 401);
            }
            // generating token
            $tokenGenerator = new TokenGeneratorController;
            $tokenData = $tokenGenerator->generateToken($request->guard);

            return response()->json([
                'status' => true,
                'message' => 'Login Successfully',
                '_token' => $tokenData['access_token'],
            ]);

        } catch (\Throwable $th) {
            // when there's a server error
            return response()->json([
                'status' => false,
                // 'message' => 'Internal Server error',
                'message' => $th->getMessage(),
            ], 500);
        }

    }
}