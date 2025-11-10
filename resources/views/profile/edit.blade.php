@extends('layouts.app')

@section('title', 'Profile Settings')
@section('header', 'Profile Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Update Profile Information -->
    <div class="card">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Profile Information</h2>
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" value="{{ $user->role->label() }}" class="form-input bg-gray-100" readonly>
                </div>

                @if($user->department)
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <input type="text" value="{{ $user->department->name }}" class="form-input bg-gray-100" readonly>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div class="card">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Update Password</h2>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-input" required>
                    @error('current_password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="card border-red-200">
        <h2 class="text-xl font-semibold text-red-600 mb-6">Delete Account</h2>
        
        <p class="text-gray-600 mb-6">
            Once your account is deleted, all of its resources and data will be permanently deleted. 
            Before deleting your account, please download any data or information that you wish to retain.
        </p>

        <button 
            type="button" 
            onclick="document.getElementById('deleteAccountModal').classList.remove('hidden')"
            class="btn btn-danger"
        >
            Delete Account
        </button>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Are you sure you want to delete your account?</h3>
        <p class="text-gray-600 mb-6">
            Once your account is deleted, all of its resources and data will be permanently deleted. 
            Please enter your password to confirm you would like to permanently delete your account.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <label for="delete_password" class="form-label">Password</label>
                <input type="password" id="delete_password" name="password" class="form-input" required>
                @error('password', 'userDeletion')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-3 mt-6">
                <button type="submit" class="btn btn-danger flex-1">Delete Account</button>
                <button 
                    type="button" 
                    onclick="document.getElementById('deleteAccountModal').classList.add('hidden')"
                    class="btn btn-secondary flex-1"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
