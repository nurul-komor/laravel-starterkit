<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyEmailValidator;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(VerifyEmailValidator $request)
    {

        if ($request->guard == 'admin') {
            $user = Admin::where(['email' => $request->email, 'remember_token' => $request->hash])->first();
        } else {
            $user = User::where(['email' => $request->email, 'remember_token' => $request->hash])->first();
        }

        if (! $request->user()->email_verified_at && $user && $request->email == $request->user()->email) {
            // marking email as verified

            $user->markEmailAsVerified();

            return response()->json([
                'status' => true,
                'message' => 'Successfully verified email',
            ], 200);

        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to verify email!',
        ], 400);
    }
}
