<?php
namespace App\Contracts;

interface PasswordValidationInterface
{
    public function isOldPasswordValid($oldPassword, $user): bool;
    public function isNewPasswordSameAsOld($newPassword, $user): bool;
}