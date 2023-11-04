<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Notifications\EmailVerificationMail;
use App\Http\Requests\EmailVerificationRequest;
use App\Http\Controllers\Api\Auth\SendEmailVerificationMailController;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    // : JsonResponse|RedirectResponse
    public function store(EmailVerificationRequest $request)
    {

        try {
            $hash = Str::random(60);

            $request->user()->forceFill([
                'remember_token' => $hash,
            ])->save();

            // sending verification mail
            $mailSender = new SendEmailVerificationMailController;

            $result = $mailSender->sendVerifyMail($request->all(), $hash, $request->guard);

        } catch (Exception $e) {
            info($e->getMessage());
            return response()->json([
                'status' => false,
                // 'message' => 'Opps! Something went wrong please try again letter',
                'message' => $e->getMessage(),

            ], 500);
        }

        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'],

        ], $result['statusCode']);
    }
}