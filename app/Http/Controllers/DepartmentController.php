<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('alumniProfiles')
            ->paginate(12);

        return view('departments.index', compact('departments'));
    }

    public function show(Department $department)
    {
        $department->load(['alumniProfiles', 'events' => function($query) {
            $query->where('event_date', '>=', now())->orderBy('event_date');
        }, 'news' => function($query) {
            $query->published()->latest('published_at')->take(5);
        }]);

        return view('departments.show', compact('department'));
    }

    public function create()
    {
        $this->authorize('create', Department::class);
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Department::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments',
            'description' => 'nullable|string',
            'head_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('departments', 'public');
        }

        $department = Department::create($validated);

        return redirect()->route('departments.show', $department)
            ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        $this->authorize('update', $department);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $this->authorize('update', $department);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments,code,' . $department->id,
            'description' => 'nullable|string',
            'head_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($department->logo) {
                Storage::disk('public')->delete($department->logo);
            }
            $validated['logo'] = $request->file('logo')->store('departments', 'public');
        }

        $department->update($validated);

        return redirect()->route('departments.show', $department)
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        if ($department->logo) {
            Storage::disk('public')->delete($department->logo);
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
