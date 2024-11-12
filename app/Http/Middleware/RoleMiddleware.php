<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();

        // Check if the user has the required role
        if ($user->role === $role) {
            return $next($request); // Allow the request to proceed
        }

        // Redirect with a message if the user doesn't have the required role
        return redirect()->route('unauthorized') // You can define an 'unauthorized' route
            ->with('error', 'You do not have permission to access this page.');
    }
}