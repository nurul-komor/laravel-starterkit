<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Notifications\EmailVerificationMail;

class SendEmailVerificationMailController
{
    public function sendVerifyMail($request, $hash, $guard): array
    {
        $model = $this->getUserModelByGuard($request['email'], $guard);

        if (!$model) {
            return [
                "status" => false,
                "message" => "Email not found",
                'statusCode' => 404
            ];
        }
        try {
            $model->notify(new EmailVerificationMail($model, $hash, $guard));
        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => "Oops! Something went wrong, please try again later",
                'statusCode' => 500
            ];
        }
        return [
            "status" => true,
            "message" => "Verification link sent",
            'statusCode' => 200
        ];


    }

    private function getUserModelByGuard($email, $guard)
    {
        if ($guard == "admin") {
            return Admin::where('email', $email)->first();
        }

        return User::where('email', $email)->first();
    }

}