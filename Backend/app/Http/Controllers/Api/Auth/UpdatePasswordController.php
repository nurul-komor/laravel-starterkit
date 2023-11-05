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

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $helper = new PasswordChangerHelperController();
        $result = $helper->updater($request);

        return response()->json($result['response'], $result['status']);
    }

}
