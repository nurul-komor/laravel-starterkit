<?php

namespace App\Http\Controllers\Api\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegistrationRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RegisterAdminController extends Controller
{
    public function register(AdminRegistrationRequest $request)
    {

        $admin = Admin::create($request->validated() + ['password' => Hash::make($request->password)]);
        if ($admin) {
            return response()->json([
                'status' => true,
                'message' => 'Registration Successful',
                'admin' => $admin,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'message' => 'Opps! something went wrong. Please try again.',
            'admin' => $admin,
        ], 500);
    }
}