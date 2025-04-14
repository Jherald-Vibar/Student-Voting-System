<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HigherPositionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the required role/position
        if (auth()->check() && auth()->user()->position !== 'HigherPosition') {
            return redirect()->route('home'); // Redirect if the user does not have access
        }

        // If no authenticated user, redirect to login page
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect to login if the user is not authenticated
        }

        return $next($request);
    }
}

