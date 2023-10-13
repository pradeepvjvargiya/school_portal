<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the user ID from the URL or request parameters
        $profileId = $request->route('id'); // Assuming the profile ID is part of the route

        // Check if the user is authorized to edit the profile
        if (auth()->user()->id == $profileId || auth()->user()->role == "admin")  {
            return $next($request);
        }

        // If not authorized, you can redirect or return an error message
        return redirect()->back()->with('error', 'You are not authorized to edit this profile.');
    }
}
