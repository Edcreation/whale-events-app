<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the authenticated user has the required role
        if (!$request->user() || !$request->user()->roles()->where('name', 'admin')->exists()) {
            // Unauthorized response if the user does not have the required role
            return response()->json([
                'message' => 'Unauthorized, You are not Admin',
                'data' => $request->user(),
            ], 403);
        }

        // User has the required role, proceed with the request
        return $next($request);
    }
}
