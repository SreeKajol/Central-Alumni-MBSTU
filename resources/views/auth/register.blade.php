<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-primary-50 to-primary-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="/images/MBSTU_logo.png" alt="MBSTU Logo" class="h-16 w-16 object-contain">
                </div>
                <h1 class="text-3xl font-bold text-primary-600 mb-2">Central Alumni MBSTU</h1>
                <p class="text-gray-600">Mawlana Bhashani Science and Technology University</p>
                <p class="text-gray-500 text-sm mt-1">Create your alumni account to get started.</p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            class="form-input" 
                            required 
                            autofocus
                        >
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="form-input" 
                            required
                        >
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
<<<<<<< HEAD
                        <p class="text-xs text-gray-500 mt-1">Use your registered alumni email</p>
                    </div>

                    <div class="form-group">
                        <label for="student_id" class="form-label">Student ID</label>
                        <input 
                            type="text" 
                            id="student_id" 
                            name="student_id" 
                            value="{{ old('student_id') }}" 
                            class="form-input" 
                            placeholder="e.g., CSE18001 or CE22001"
                            required
                        >
                        @error('student_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Enter your MBSTU student ID</p>
=======
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input" 
                            required
                        >
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-input" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        Create Account
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 font-medium">Sign in here</a>
                    </p>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-800 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
<<<<<<< HEAD
                <p class="text-sm text-blue-800 mb-2">
                    <strong>🔒 Verified Alumni Only:</strong> Registration is restricted to verified alumni only. 
                    You must provide your registered email and student ID that matches our alumni records.
                </p>
                <p class="text-sm text-blue-800">
                    Your profile will be automatically verified upon successful registration with your education 
                    details pre-filled from our records.
=======
                <p class="text-sm text-blue-800">
                    <strong>Note:</strong> After registration, you'll be able to create your complete alumni profile 
                    with your education details, career information, and more.
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                </p>
            </div>
        </div>
    </div>
</body>
</html>
