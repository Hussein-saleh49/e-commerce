<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Redirect to login if user is not authenticated
            return redirect()->route('login.show')->with('error', 'Please login first.');
        }

        return $next($request);
    }
}
