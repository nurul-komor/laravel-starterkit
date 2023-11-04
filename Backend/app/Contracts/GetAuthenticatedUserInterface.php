<?php

namespace App\Contracts;

// Create an interface for the authentication service
interface GetAuthenticatedUserInterface
{
    public function getAuthenticatedUser(string $guard, array $data);
}
