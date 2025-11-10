<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifiedAlumniData;
use App\Models\AlumniProfile;
use App\Models\Department;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'student_id' => ['required', 'string'],
        ]);

        // Verify against predefined alumni data
        $verifiedData = VerifiedAlumniData::verifyAlumni(strtolower($request->email), $request->student_id);

        if (!$verifiedData) {
            return back()->withErrors([
                'email' => 'The provided email and student ID do not match our alumni records. Only verified alumni can register.',
            ])->withInput($request->only('name', 'email', 'student_id'));
        }

        // Extract department code from student ID (first 2-3 letters)
        // E.g., CSE18001 -> CSE, EEE19001 -> EEE
        $deptCode = preg_replace('/[0-9]+/', '', $request->student_id);
        $department = Department::where('code', $deptCode)->first();

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRole::ALUMNI,
            'department_id' => $department?->id,
        ]);

        // Create alumni profile automatically with verified data
        AlumniProfile::create([
            'user_id' => $user->id,
            'department_id' => $department?->id,
            'student_id' => $verifiedData->student_id,
            'batch_year' => $verifiedData->batch_year,
            'graduation_year' => $verifiedData->graduation_year,
            'degree' => $verifiedData->degree,
            'phone' => $verifiedData->phone,
            'is_verified' => true, // Automatically verified
            'is_profile_public' => false, // Let user decide later
        ]);

        // Mark the verified data as used
        $verifiedData->markAsUsed();

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome! Your account has been created and verified.');
    }
}
