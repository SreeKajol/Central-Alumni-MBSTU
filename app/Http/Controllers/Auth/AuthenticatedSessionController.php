<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

<<<<<<< HEAD
        // Convert email to lowercase for case-insensitive login
        $credentials = [
            'email' => strtolower($request->email),
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Check if alumni user needs to complete their profile
            if ($user->isAlumni() && !$user->alumniProfile) {
                // Allow login but redirect to create profile
                $request->session()->regenerate();
                return redirect()->route('alumni.create')
                    ->with('info', 'Please complete your alumni profile to access all features.');
            }
            
            // Check if alumni profile needs verification
            if ($user->isAlumni() && $user->alumniProfile && !$user->alumniProfile->is_verified) {
                // Allow login but show a notification
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'))
                    ->with('warning', 'Your profile is pending verification by the administrator.');
            }

=======
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
