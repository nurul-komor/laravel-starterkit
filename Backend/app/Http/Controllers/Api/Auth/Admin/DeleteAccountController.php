<?php
// need
namespace App\Http\Controllers\Api\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteAccountRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;

class DeleteAccountController extends Controller
{
    //  admin delete

    public function deleteAdmin(DeleteAccountRequest $request)
    {
        $request_user = Admin::find($request->id);

        if (!$request_user) {
            return $this->adminNotFoundResponse();
        }

        if ($this->isSuperAdmin($request_user)) {
            return $this->superAdminCannotBeDeletedResponse();
        }

        if (!$this->isConfirmationText($request->text)) {
            return $this->invalidTextResponse();
        }

        if (!$this->isMatchingEmail($request_user, $request->email)) {
            return $this->invalidEmailResponse();
        }

        $request_user->delete();

        return $this->successResponse();
    }



    private function isSuperAdmin($user)
    {
        return $user->is_superadmin == 1;
    }

    private function isConfirmationText($text)
    {
        return in_array(strtolower($text), ['confirm']);
    }

    private function isMatchingEmail($user, $email)
    {
        return $user->email == $email;
    }

    private function isCurrentUser($user, $request_user)
    {
        return $user === $request_user;
    }

    private function adminNotFoundResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Admin not found.',
        ], 409);
    }

    private function superAdminCannotBeDeletedResponse()
    {
        return response()->json([
            'status' => false,
            'message' => "Superadmin can't be deleted",
        ], 401);
    }

    private function invalidTextResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Invalid text',
        ], 409);
    }

    private function invalidEmailResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Invalid Email',
        ], 409);
    }


    private function successResponse()
    {
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }
}