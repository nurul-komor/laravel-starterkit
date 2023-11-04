<?php

namespace App\Http\Controllers\Api\Auth\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Traits\ImageUploadTrait;

class UpdateUserProfileController extends Controller
{
    use ImageUploadTrait;
    // Login user profile update
    public function updateProfile(UserProfileUpdateRequest $request)
    {
        $user = User::find(auth('user')->user()->id);
        return $user;
        /* ------------------------ when you have image field ----------------------- */
        $profile_image = $this->uploadImage($request->file('profile_image'), "users");
        if ($profile_image == null) {
            $profile_image = $user->profile_image;
        }

        $user->update(array_merge($request->all(), ['profile_image' => $profile_image]));

        /* ------------------------ when you have image field ----------------------- */
        // $user->update($request->all());
        // $user = User::find(auth('user')->user()->id);
        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }
}