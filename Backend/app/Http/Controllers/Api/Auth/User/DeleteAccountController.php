<?php

namespace App\Http\Controllers\Api\Auth\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DeleteAccountRequest;

class DeleteAccountController extends Controller
{
    //  Delete User Account
    // public function deleteAccount(DeleteAccountRequest $request)
    // {


    //     // check text match or not
    //     if ($request->text == 'confirm' || $request->text == 'Confirm') {

    //         // check user exist or not
    //         $request_user = User::find($request->id);
    //         if (!$request_user) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'User not found',
    //             ], 409);
    //         }

    //         // check user email match or not
    //         if ($request_user->email == $request->email) {
    //             if ($request_user) {
    //                 $user = auth()->user();

    //                 if ($user == $request_user) {
    //                     $request_user->delete();

    //                     return response()->json([
    //                         'status' => true,
    //                         'message' => 'User deleted successfully',
    //                     ], 200);
    //                 } else {
    //                     return response()->json([
    //                         'status' => false,
    //                         'message' => 'User not found',
    //                     ], 409);
    //                 }
    //             } else {
    //                 return response()->json([
    //                     'status' => false,
    //                     'message' => 'User not found',
    //                 ], 409);
    //             }
    //         } else {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Invalid Email',
    //             ], 409);
    //         }
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Invalid text',
    //         ], 409);
    //     }
    // }


    public function deleteAccount(DeleteAccountRequest $request)
    {
        if (!$this->isConfirmationText($request->text)) {
            return $this->invalidTextResponse();
        }

        $request_user = User::find($request->id);

        if (!$request_user) {
            return $this->userNotFoundResponse();
        }

        if (!$this->isMatchingEmail($request_user, $request->email)) {
            return $this->invalidEmailResponse();
        }

        $user = auth()->user();


        if (!$this->isCurrentUser($user, $request_user)) {

            return $this->userNotFoundResponse();
        }

        $request_user->delete();

        return $this->successResponse();
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
        return $user == $request_user;
    }

    private function invalidTextResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Invalid text',
        ], 409);
    }

    private function userNotFoundResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'User not found',
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