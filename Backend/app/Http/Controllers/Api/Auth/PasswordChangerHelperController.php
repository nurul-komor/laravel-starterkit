<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Controllers\Api\Auth\PasswordValidatorController;

class PasswordChangerHelperController
{
    public function updater(UpdateUserPasswordRequest $request, $guard = null)
    {
        $user = auth($guard)->user();

        $passwordValidator = new PasswordValidatorController();

        if (!$passwordValidator->isOldPasswordValid($request->old_password, $user)) {
            return [
                'status' => 401,
                'response' => [
                    'status' => false,
                    'message' => "Current password doesn't match.",
                ],
            ];
        }

        if ($passwordValidator->isNewPasswordSameAsOld($request->new_password, $user)) {
            return [
                'status' => 401,
                'response' => [
                    'status' => false,
                    'message' => 'You had the entire previous password.',
                ],
            ];
        }

        $this->updateUserPassword($request->new_password, $user);

        return [
            'status' => 200,
            'response' => [
                'status' => true,
                'message' => 'Password successfully updated',
            ],
        ];
    }

    private function updateUserPassword($newPassword, $user)
    {
        $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }
}