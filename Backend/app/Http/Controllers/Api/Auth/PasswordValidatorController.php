<?php
// need
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Hash;
use App\Contracts\PasswordValidationInterface;

class PasswordValidatorController implements PasswordValidationInterface
{
    public function isOldPasswordValid($oldPassword, $user): bool
    {
        return Hash::check($oldPassword, $user->password);
    }

    public function isNewPasswordSameAsOld($newPassword, $user): bool
    {
        return Hash::check($newPassword, $user->password);
    }
}
