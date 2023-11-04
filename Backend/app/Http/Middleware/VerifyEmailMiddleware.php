<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        if (Setting::first() && Setting::first()->email_verification == 1 && $request->user()->email_verified_at == null) {
            if (
                !$request->user() ||
                ($request->user() instanceof MustVerifyEmail &&
                    !$request->user()->hasVerifiedEmail())
            ) {
                return $request->expectsJson()
                    ? response()->json([
                        'status' => false,
                        'message' => 'Please Verify your mail to continue',
                    ], 404)
                    : $next($request);
            }
        }

        return $next($request);
    }
}
