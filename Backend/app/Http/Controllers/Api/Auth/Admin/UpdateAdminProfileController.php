<?php

namespace App\Http\Controllers\Api\Auth\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminProfileUpdateRequest;

class UpdateAdminProfileController extends Controller
{
    use ImageUploadTrait;
    // Login user profile update
    public function updateProfile(AdminProfileUpdateRequest $request)
    {


        $admin = Admin::find(auth('admin')->user()->id);

        /* ------------------------ when you have image field ----------------------- */
        $profile_image = $this->uploadImage($request->file('profile_image'), "admins");
        if ($profile_image == null) {
            $profile_image = $admin->profile_image;
        }

        $admin->update(array_merge($request->all(), ['profile_image' => $profile_image]));

        /* ------------------------ when you have image field ----------------------- */
        // $user->update($request->all());
        // returning user after update
        $admin = Admin::find(auth('admin')->user()->id);
        return response()->json([
            'status' => true,
            'message' => 'Profile successfully updated',
            'admin' => $admin,
        ], 200);
    }
}
