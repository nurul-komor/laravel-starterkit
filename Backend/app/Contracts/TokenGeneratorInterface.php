<?php

namespace App\Contracts;

// Create an interface for the authentication service
interface TokenGeneratorInterface
{
    public function generateToken(string $guard): array;
}
