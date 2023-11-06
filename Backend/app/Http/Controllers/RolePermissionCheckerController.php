<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RolePermissionCheckerRequest;

class RolePermissionCheckerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RolePermissionCheckerRequest $request)
    {

        if (auth($request->guard)->check() && auth($request->guard)->user()->can($request->permission)) {
            return response()->json([
                'status' => true,
                "message" => "You can go ahead"
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                "message" => "You are permitted"
            ], 401);
        }
    }
}
