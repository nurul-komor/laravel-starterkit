<?php
// need
namespace App\Http\Controllers\Api\Auth\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DeleteAccountRequest;

class DeleteAccountController extends Controller
{
    //  Delete User Account


    public function deleteAccount(DeleteAccountRequest $request)
    {
        // Check if the provided text is "confirm"
        if (!$this->isConfirmationText($request->text)) {
            return $this->invalidTextResponse();
        }

        // Find the user with the given ID
        $request_user = User::find($request->id);

        // If the user doesn't exist, return a response
        if (!$request_user) {
            return $this->userNotFoundResponse();
        }

        // Check if the provided email matches the user's email
        if (!$this->isMatchingEmail($request_user, $request->email)) {
            return $this->invalidEmailResponse();
        }

        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the authenticated user matches the user to be deleted
        if (!$this->isCurrentUser($user, $request_user)) {
            return $this->userNotFoundResponse();
        }

        // Delete the user
        $request_user->delete();

        // Return a success response
        return $this->successResponse();
    }

    // Helper function to check if the provided text is "confirm"
    private function isConfirmationText($text)
    {
        return in_array(strtolower($text), ['confirm']);
    }

    // Helper function to check if the provided email matches the user's email
    private function isMatchingEmail($user, $email)
    {
        return $user->email == $email;
    }

    // Helper function to check if the authenticated user matches the user to be deleted
    private function isCurrentUser($user, $request_user)
    {
        return $user == $request_user;
    }

    // Helper function to return an error response for invalid text
    private function invalidTextResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Invalid text',
        ], 409);
    }

    // Helper function to return an error response for a user not found
    private function userNotFoundResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'User not found',
        ], 409);
    }

    // Helper function to return an error response for an invalid email
    private function invalidEmailResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Invalid Email',
        ], 409);
    }

    // Helper function to return a success response
    private function successResponse()
    {
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

}