<?php
// need
namespace App\Http\Controllers\Api\Auth;

use App\Contracts\GetAuthenticatedUserInterface;
use App\Http\Controllers\Controller;

class GetAuthenticatedUserController extends Controller implements GetAuthenticatedUserInterface
{
    public function getAuthenticatedUser(string $guard, array $data)
    {
        return auth($guard)->user();
    }
}