<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\EmailVerificationMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request, $guard = null): JsonResponse|RedirectResponse
    {

        try {
            $hash = Str::random(60);

            $request->user()->forceFill([
                'remember_token' => $hash,
            ])->save();

            // sending verification mail
            $request->user()->notify(new EmailVerificationMail($request->user(), $hash, $guard));
        } catch (Exception $e) {
            info($e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Opps! Something went wrong please try again letter',

            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Verification link sent',

        ], 200);
    }
}
