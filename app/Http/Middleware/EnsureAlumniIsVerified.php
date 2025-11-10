<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAlumniIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Allow non-alumni users (admins, etc.)
        if (!$user->isAlumni()) {
            return $next($request);
        }

        // Check if alumni has a verified profile
        $alumniProfile = $user->alumniProfile;

        if (!$alumniProfile || !$alumniProfile->is_verified) {
            return redirect()->route('dashboard')->with('error', 'Your alumni profile is not verified. Please contact the administrator.');
        }

        return $next($request);
    }
}
