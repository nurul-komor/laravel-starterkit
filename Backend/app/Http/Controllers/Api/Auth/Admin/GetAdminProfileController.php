<?php
// need
namespace App\Http\Controllers\Api\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

class GetAdminProfileController extends Controller
{
    // Admin  user Profile
    public function profile()
    {
        if (auth()->guard('admin')) {
            return response()->json(auth('admin')->user());
        }
    }
}