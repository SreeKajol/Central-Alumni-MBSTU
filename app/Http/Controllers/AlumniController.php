<?php

namespace App\Http\Controllers;

use App\Models\AlumniProfile;
use App\Models\AlumniPhoto;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = AlumniProfile::with(['user', 'department'])
            ->where('is_profile_public', true);

        // Search filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        if ($request->filled('batch_year')) {
            $query->where('batch_year', $request->batch_year);
        }

        if ($request->filled('graduation_year')) {
            $query->where('graduation_year', $request->graduation_year);
        }

        if ($request->filled('industry')) {
            $query->where('industry', 'like', "%{$request->industry}%");
        }

        $alumni = $query->latest()->paginate(12);
        $departments = Department::all();
        
        // Get unique batch years for filter
        $batchYears = AlumniProfile::distinct()
            ->orderByDesc('batch_year')
            ->pluck('batch_year');

        return view('alumni.index', compact('alumni', 'departments', 'batchYears'));
    }

    public function archive(Request $request)
    {
        $query = AlumniPhoto::where('is_published', true);

        // Search filters
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('event_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $photos = $query->latest()->paginate(24);
        
        // Get unique years and categories for filters
        $years = AlumniPhoto::distinct()
            ->whereNotNull('year')
            ->orderByDesc('year')
            ->pluck('year');

        $categories = ['reunion', 'event', 'ceremony', 'campus', 'sports', 'cultural', 'graduation'];

        return view('alumni.archive', compact('photos', 'years', 'categories'));
    }

    public function show(AlumniProfile $alumni)
    {
        if (!$alumni->is_profile_public && auth()->id() !== $alumni->user_id) {
            abort(403, 'This profile is private.');
        }

        $alumni->load(['user', 'department']);
        $batchMates = $alumni->getBatchMates()->take(6);

        return view('alumni.show', compact('alumni', 'batchMates'));
    }

    public function create()
    {
        if (auth()->user()->alumniProfile) {
            return redirect()->route('profile.edit')
                ->with('info', 'You already have an alumni profile.');
        }

        $departments = Department::all();
        return view('alumni.create', compact('departments'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->alumniProfile) {
            return redirect()->route('profile.edit')
                ->with('info', 'You already have an alumni profile.');
        }

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'student_id' => 'nullable|string|max:50',
            'batch_year' => 'required|integer|min:1950|max:' . (date('Y') + 1),
            'graduation_year' => 'required|integer|min:1950|max:' . (date('Y') + 5),
            'degree' => 'required|string|max:100',
            'major' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|max:2048',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'current_company' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:100',
            'linkedin_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'bio' => 'nullable|string|max:1000',
            'is_profile_public' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        
        // Ensure is_profile_public is set (checkbox won't send value if unchecked)
        $validated['is_profile_public'] = $request->has('is_profile_public');

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')
                ->store('profiles', 'public');
        }

        $profile = AlumniProfile::create($validated);

        return redirect()->route('alumni.show', $profile)
            ->with('success', 'Alumni profile created successfully.');
    }

    public function edit(AlumniProfile $alumni)
    {
        $this->authorize('update', $alumni);
        $departments = Department::all();
        return view('alumni.edit', compact('alumni', 'departments'));
    }

    public function update(Request $request, AlumniProfile $alumni)
    {
        $this->authorize('update', $alumni);

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'student_id' => 'nullable|string|max:50',
            'batch_year' => 'required|integer|min:1950|max:' . (date('Y') + 1),
            'graduation_year' => 'required|integer|min:1950|max:' . (date('Y') + 5),
            'degree' => 'required|string|max:100',
            'major' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|max:2048',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'current_company' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:100',
            'linkedin_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'bio' => 'nullable|string|max:1000',
            'is_profile_public' => 'boolean',
        ]);
        
        // Ensure is_profile_public is set (checkbox won't send value if unchecked)
        $validated['is_profile_public'] = $request->has('is_profile_public');

        if ($request->hasFile('profile_photo')) {
            if ($alumni->profile_photo) {
                Storage::disk('public')->delete($alumni->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')
                ->store('profiles', 'public');
        }

        $alumni->update($validated);

        return redirect()->route('alumni.show', $alumni)
            ->with('success', 'Profile updated successfully.');
    }

    public function destroy(AlumniProfile $alumni)
    {
        $this->authorize('delete', $alumni);

        if ($alumni->profile_photo) {
            Storage::disk('public')->delete($alumni->profile_photo);
        }

        $alumni->delete();

        return redirect()->route('alumni.index')
            ->with('success', 'Alumni profile deleted successfully.');
    }
}
