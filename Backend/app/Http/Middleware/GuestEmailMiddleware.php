<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if (Setting::first()->email_verification == 0) {
            return response()->json([
                'status' => false,
                'message' => "You are to permitted to perform this action!",
            ], 403);
        }
        if ($request->user($guard)->email_verified_at == null) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'The email already verified!',
        ], 403);
    }
}