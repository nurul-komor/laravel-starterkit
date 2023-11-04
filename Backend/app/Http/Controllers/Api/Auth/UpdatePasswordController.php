<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Controllers\Api\Auth\PasswordChangerHelperController;

class UpdatePasswordController extends Controller
{
    // Update Password
    // public function updatePassword(UpdateUserPasswordRequest $request)
    // {

    //     $user = User::find(auth('user')->user()->id);

    //     if (!Hash::check($request->old_password, $user->password)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => "Current password doesn't match.",
    //         ], 401);
    //     }

    //     if (Hash::check($request->new_password, $user->password)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'You had entire previous password.',
    //         ], 401);
    //     } else {
    //         $user->update([
    //             'password' => Hash::make($request->new_password),
    //         ]);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Password successfully updated',
    //         ], 200);
    //     }
    // }
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $helper = new PasswordChangerHelperController();
        $result = $helper->updater($request);

        return response()->json($result['response'], $result['status']);
    }

}