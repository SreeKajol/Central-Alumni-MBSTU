<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name') }}</title>
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
                <p class="text-gray-500 text-sm mt-1">Welcome back! Please login to your account.</p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="form-input" 
                            required 
                            autofocus
                        >
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>

                        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-800">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        Sign In
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-800 font-medium">Register here</a>
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

            <!-- Demo Credentials -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm font-semibold text-blue-800 mb-2">Demo Credentials:</p>
                <div class="text-xs text-blue-700 space-y-1">
                    <p><strong>Super Admin:</strong> admin@alumni.edu / password</p>
                    <p><strong>Department Admin:</strong> cse@university.edu / password</p>
                    <p><strong>Alumni:</strong> alice@example.com / password</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
