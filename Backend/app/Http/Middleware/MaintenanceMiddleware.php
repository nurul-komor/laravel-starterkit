<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = Setting::first();
        if ($settings->maintenance_mode == 1) {
            abort(response()->json([
                'status' => false,
                'message' => 'This site is under construction',
            ]));
        }

        return $next($request);
    }
}
