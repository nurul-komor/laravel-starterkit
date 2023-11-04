<?php

namespace App\Http\Controllers\Api\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminPasswordRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    //  Update Password
    public function updatePassword(UpdateAdminPasswordRequest $request)
    {

        $admin = Admin::find(auth('admin')->user()->id);

        if (! Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => "Current password doesn't match.",
            ], 401);
        }

        if (Hash::check($request->new_password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'You entired previous password.',
            ], 401);
        } else {
            $admin->update([
                'password' => Hash::make($request->new_password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password successfully updated',
                'admin' => $admin,
            ], 200);
        }
    }
}
