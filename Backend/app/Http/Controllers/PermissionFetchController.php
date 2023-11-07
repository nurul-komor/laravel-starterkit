<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RolePermissionCheckerRequest;

class PermissionFetchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RolePermissionCheckerRequest $request)
    {

        if (auth($request->guard)->check()) {
            $query = $request->guard == "admin" ? Admin::latest() : User::latest();
            $model = $query->find(auth($request->guard)->user()->id);


            return response()->json([
                'status' => true,
                'permissions' => $this->getPermissions($model)
            ]);


        } else {
            return response()->json([
                'status' => false,
                "message" => "Unauthorized!"
            ], 401);
        }
    }


    /**
     *
     *  returns all the permissions that a model has
     *
     */

    private function getPermissions($model)
    {
        // getting roles
        $roles = $model->roles;
        // Initialize an empty array to store user's permissions
        $hasPermissions = [];

        // Loop through the roles associated with the users or admins
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            $permissionNames[] = $permissions->pluck('name');

        }
        return $permissionNames;
    }




}