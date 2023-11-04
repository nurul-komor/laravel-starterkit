<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Verified;

class EmailMarkAsVerifiedController extends Controller
{
    /**
     * Mark the user's email as verified and dispatch the Verified event.
     *
     * @param  User|Admin  $user
     */
    public function markEmailAsVerified($user)
    {
        $user->markEmailAsVerified();

        return 1;
    }
}
