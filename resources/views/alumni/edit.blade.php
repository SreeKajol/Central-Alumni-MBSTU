@extends('layouts.app')

@section('title', 'Edit Alumni Profile')
@section('header', 'Edit Alumni Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Edit Your Alumni Profile</h2>
            <p class="mt-2 text-sm text-gray-600">Update your profile information to keep other alumni connected with you.</p>
        </div>

        <form action="{{ route('alumni.update', $alumni) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="department_id" class="form-label required">Department</label>
                        <select id="department_id" name="department_id" class="form-select @error('department_id') border-red-500 @enderror" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $alumni->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }} ({{ $department->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="student_id" class="form-label">Student ID</label>
                        <input type="text" id="student_id" name="student_id" value="{{ old('student_id', $alumni->student_id) }}" class="form-input @error('student_id') border-red-500 @enderror" placeholder="e.g., 2018-CS-001">
                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch_year" class="form-label required">Batch Year</label>
                        <input type="number" id="batch_year" name="batch_year" value="{{ old('batch_year', $alumni->batch_year) }}" min="1950" max="{{ date('Y') + 1 }}" class="form-input @error('batch_year') border-red-500 @enderror" required>
                        @error('batch_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="graduation_year" class="form-label required">Graduation Year</label>
                        <input type="number" id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $alumni->graduation_year) }}" min="1950" max="{{ date('Y') + 5 }}" class="form-input @error('graduation_year') border-red-500 @enderror" required>
                        @error('graduation_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="degree" class="form-label required">Degree</label>
                        <input type="text" id="degree" name="degree" value="{{ old('degree', $alumni->degree) }}" class="form-input @error('degree') border-red-500 @enderror" placeholder="e.g., Bachelor of Science" required>
                        @error('degree')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="major" class="form-label">Major</label>
                        <input type="text" id="major" name="major" value="{{ old('major', $alumni->major) }}" class="form-input @error('major') border-red-500 @enderror" placeholder="e.g., Computer Science">
                        @error('major')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="profile_photo" class="form-label">Profile Photo</label>
                        @if($alumni->profile_photo)
                            <div class="mb-2">
                                <img src="{{ $alumni->profilePhotoUrl }}" alt="Current profile photo" class="w-20 h-20 rounded-full object-cover">
                                <p class="text-xs text-gray-500 mt-1">Current photo</p>
                            </div>
                        @endif
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="form-input @error('profile_photo') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Max 2MB. Leave empty to keep current photo.</p>
                        @error('profile_photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $alumni->date_of_birth?->format('Y-m-d')) }}" class="form-input @error('date_of_birth') border-red-500 @enderror">
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $alumni->phone) }}" class="form-input @error('phone') border-red-500 @enderror" placeholder="+1234567890">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $alumni->city) }}" class="form-input @error('city') border-red-500 @enderror">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="country" class="form-label">Country</label>
                        <input type="text" id="country" name="country" value="{{ old('country', $alumni->country) }}" class="form-input @error('country') border-red-500 @enderror">
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" name="address" rows="2" class="form-input @error('address') border-red-500 @enderror">{{ old('address', $alumni->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Career Information -->
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Career Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="current_company" class="form-label">Current Company</label>
                        <input type="text" id="current_company" name="current_company" value="{{ old('current_company', $alumni->current_company) }}" class="form-input @error('current_company') border-red-500 @enderror">
                        @error('current_company')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="current_position" class="form-label">Current Position</label>
                        <input type="text" id="current_position" name="current_position" value="{{ old('current_position', $alumni->current_position) }}" class="form-input @error('current_position') border-red-500 @enderror">
                        @error('current_position')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="industry" class="form-label">Industry</label>
                        <input type="text" id="industry" name="industry" value="{{ old('industry', $alumni->industry) }}" class="form-input @error('industry') border-red-500 @enderror" placeholder="e.g., Technology, Healthcare, Finance">
                        @error('industry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Social Links</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="linkedin_url" class="form-label">LinkedIn</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $alumni->linkedin_url) }}" class="form-input @error('linkedin_url') border-red-500 @enderror" placeholder="https://linkedin.com/in/yourprofile">
                        @error('linkedin_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="facebook_url" class="form-label">Facebook</label>
                        <input type="url" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $alumni->facebook_url) }}" class="form-input @error('facebook_url') border-red-500 @enderror" placeholder="https://facebook.com/yourprofile">
                        @error('facebook_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="twitter_url" class="form-label">Twitter</label>
                        <input type="url" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $alumni->twitter_url) }}" class="form-input @error('twitter_url') border-red-500 @enderror" placeholder="https://twitter.com/yourprofile">
                        @error('twitter_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="website_url" class="form-label">Personal Website</label>
                        <input type="url" id="website_url" name="website_url" value="{{ old('website_url', $alumni->website_url) }}" class="form-input @error('website_url') border-red-500 @enderror" placeholder="https://yourwebsite.com">
                        @error('website_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bio -->
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">About You</h3>
                <div>
                    <label for="bio" class="form-label">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="form-input @error('bio') border-red-500 @enderror" placeholder="Tell us about yourself, your achievements, interests...">{{ old('bio', $alumni->bio) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Maximum 1000 characters</p>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Privacy Settings -->
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Privacy Settings</h3>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="is_profile_public" name="is_profile_public" value="1" {{ old('is_profile_public', $alumni->is_profile_public) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    </div>
                    <div class="ml-3">
                        <label for="is_profile_public" class="font-medium text-gray-700">Make my profile public</label>
                        <p class="text-sm text-gray-500">Allow other alumni and visitors to view your profile</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t flex items-center justify-between">
                <a href="{{ route('alumni.show', $alumni) }}" class="btn btn-secondary">Cancel</a>
<<<<<<< HEAD
                <button type="submit" class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Profile
                </button>
            </div>
        </form>

        <!-- Delete Form (separate from update form) -->
        <form action="{{ route('alumni.destroy', $alumni) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">
                Delete Profile
            </button>
        </form>
=======
                <div class="flex space-x-3">
                    <form action="{{ route('alumni.destroy', $alumni) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">
                            Delete Profile
                        </button>
                    </form>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
    </div>
</div>

<style>
    .form-label.required::after {
        content: " *";
        color: #ef4444;
    }
</style>
@endsection
