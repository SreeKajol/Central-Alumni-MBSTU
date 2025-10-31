@extends('layouts.app')

@section('title', 'Edit Department')
@section('header', 'Edit Department')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Edit Department</h2>
            <p class="mt-2 text-sm text-gray-600">Update department information and contact details.</p>
        </div>

        <form action="{{ route('departments.update', $department) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Department Name -->
            <div>
                <label for="name" class="form-label required">Department Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $department->name) }}" class="form-input @error('name') border-red-500 @enderror" placeholder="e.g., Computer Science & Engineering" required autofocus>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Department Code -->
            <div>
                <label for="code" class="form-label required">Department Code</label>
                <input type="text" id="code" name="code" value="{{ old('code', $department->code) }}" class="form-input @error('code') border-red-500 @enderror" placeholder="e.g., CSE" maxlength="10" required>
                <p class="mt-1 text-xs text-gray-500">Short code for the department (e.g., CSE, EEE, BBA)</p>
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="4" class="form-input @error('description') border-red-500 @enderror" placeholder="Describe the department's focus and programs...">{{ old('description', $department->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Department Head -->
            <div>
                <label for="head_name" class="form-label">Department Head</label>
                <input type="text" id="head_name" name="head_name" value="{{ old('head_name', $department->head_name) }}" class="form-input @error('head_name') border-red-500 @enderror" placeholder="e.g., Dr. John Smith">
                @error('head_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_email" class="form-label">Contact Email</label>
                    <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $department->contact_email) }}" class="form-input @error('contact_email') border-red-500 @enderror" placeholder="dept@university.edu">
                    @error('contact_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_phone" class="form-label">Contact Phone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $department->contact_phone) }}" class="form-input @error('contact_phone') border-red-500 @enderror" placeholder="+1234567890">
                    @error('contact_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Department Logo -->
            <div>
                <label for="logo" class="form-label">Department Logo</label>
                @if($department->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $department->logo) }}" alt="{{ $department->name }} logo" class="w-20 h-20 rounded-lg object-cover">
                        <p class="text-xs text-gray-500 mt-1">Current logo</p>
                    </div>
                @endif
                <input type="file" id="logo" name="logo" accept="image/*" class="form-input @error('logo') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Max 2MB. Leave empty to keep current logo.</p>
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t flex items-center justify-between">
                <a href="{{ route('departments.show', $department) }}" class="btn btn-secondary">Cancel</a>
                <div class="flex space-x-3">
                    @if(auth()->check() && auth()->user()->isSuperAdmin())
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department? All associated data will be affected.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">
                            Delete Department
                        </button>
                    </form>
                    @endif
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Department
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Department Statistics -->
    <div class="card mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Department Statistics</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-3xl font-bold text-primary-600">{{ $department->alumniProfiles()->count() }}</p>
                <p class="text-sm text-gray-600 mt-1">Alumni</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-3xl font-bold text-green-600">{{ $department->events()->count() }}</p>
                <p class="text-sm text-gray-600 mt-1">Events</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-3xl font-bold text-purple-600">{{ $department->news()->count() }}</p>
                <p class="text-sm text-gray-600 mt-1">News</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-3xl font-bold text-blue-600">{{ $department->users()->where('role', 'department_admin')->count() }}</p>
                <p class="text-sm text-gray-600 mt-1">Admins</p>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label.required::after {
        content: " *";
        color: #ef4444;
    }
</style>
@endsection
