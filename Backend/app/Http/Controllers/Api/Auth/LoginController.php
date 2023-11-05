<?php
// need
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            // Extract email and password from the request
            $credentials = $request->only('email', 'password');

            // Determine the authentication guard; default to "user" if not specified
            $guard = $request->guard ? $request->guard : "user";

            // Create an instance of the AuthenticatorController to handle authentication
            $authenticator = new AuthenticatorController;

            // Call the authentication method with provided credentials and guard
            if (!$authenticator->authenticate($credentials, $guard)) {
                // If authentication fails, return an error response
                return response()->json([
                    'status' => false,
                    'message' => 'Credentials not matched to the records!',
                ], 401);
            }

            // Create an instance of the TokenGeneratorController to generate a token
            $tokenGenerator = new TokenGeneratorController;

            // Generate a token for the specified guard
            $tokenData = $tokenGenerator->generateToken($guard);

            // Return a success response with the generated token
            return response()->json([
                'status' => true,
                'message' => 'Login Successfully',
                '_token' => $tokenData['access_token'],
            ]);

        } catch (\Throwable $th) {
            // Handle exceptions and return a server error response with the exception message
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

}