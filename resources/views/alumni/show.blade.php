@extends('layouts.app')

@section('title', $alumni->user->name)
@section('header', 'Alumni Profile')

@section('content')
<div class="space-y-6">
    <!-- Profile Header -->
    <div class="card">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-start space-x-6">
                <div class="relative inline-block flex-shrink-0">
                    @if($alumni->profile_photo)
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full blur opacity-25"></div>
                        <img src="{{ $alumni->profilePhotoUrl }}" alt="{{ $alumni->user->name }}" class="relative w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg ring-4 ring-primary-100">
                    @else
                        <div class="w-24 h-24 rounded-full bg-primary-100 flex items-center justify-center ring-4 ring-primary-50 shadow-lg border-4 border-white">
                            <span class="text-4xl font-bold text-primary-600">{{ substr($alumni->user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $alumni->user->name }}</h1>
                    <p class="text-lg text-gray-600 mt-1">{{ $alumni->department->name }}</p>
                    
                    @if($alumni->current_position && $alumni->current_company)
                        <p class="text-gray-700 mt-2">{{ $alumni->current_position }} at {{ $alumni->current_company }}</p>
                    @endif

                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($alumni->is_verified)
                            <span class="badge badge-success">✓ Verified</span>
                        @endif
                        <span class="badge badge-primary">Batch {{ $alumni->batch_year }}</span>
                    </div>
                </div>
            </div>

            @can('update', $alumni)
                <a href="{{ route('alumni.edit', $alumni) }}" class="btn btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Profile
                </a>
            @endcan
        </div>

        @if($alumni->bio)
            <div class="mt-6 pt-6 border-t">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">About</h3>
                <p class="text-gray-700">{{ $alumni->bio }}</p>
            </div>
        @endif

        <!-- Social Links -->
        @if($alumni->linkedin_url || $alumni->facebook_url || $alumni->twitter_url || $alumni->website_url)
            <div class="mt-6 pt-6 border-t">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Connect</h3>
                <div class="flex flex-wrap gap-2">
                    @if($alumni->linkedin_url)
                        <a href="{{ $alumni->linkedin_url }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                            LinkedIn
                        </a>
                    @endif
                    @if($alumni->facebook_url)
                        <a href="{{ $alumni->facebook_url }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                            Facebook
                        </a>
                    @endif
                    @if($alumni->twitter_url)
                        <a href="{{ $alumni->twitter_url }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 text-sm">
                            Twitter
                        </a>
                    @endif
                    @if($alumni->website_url)
                        <a href="{{ $alumni->website_url }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm">
                            Website
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Education Details -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Education</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Degree</p>
                    <p class="font-medium text-gray-900">{{ $alumni->degree }}</p>
                </div>
                @if($alumni->major)
                    <div>
                        <p class="text-sm text-gray-500">Major</p>
                        <p class="font-medium text-gray-900">{{ $alumni->major }}</p>
                    </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Batch Year</p>
                    <p class="font-medium text-gray-900">{{ $alumni->batch_year }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Graduation Year</p>
                    <p class="font-medium text-gray-900">{{ $alumni->graduation_year }}</p>
                </div>
                @if($alumni->student_id)
                    <div>
                        <p class="text-sm text-gray-500">Student ID</p>
                        <p class="font-medium text-gray-900">{{ $alumni->student_id }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Career Information -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Career</h2>
            <div class="space-y-3">
                @if($alumni->current_company)
                    <div>
                        <p class="text-sm text-gray-500">Current Company</p>
                        <p class="font-medium text-gray-900">{{ $alumni->current_company }}</p>
                    </div>
                @endif
                @if($alumni->current_position)
                    <div>
                        <p class="text-sm text-gray-500">Position</p>
                        <p class="font-medium text-gray-900">{{ $alumni->current_position }}</p>
                    </div>
                @endif
                @if($alumni->industry)
                    <div>
                        <p class="text-sm text-gray-500">Industry</p>
                        <p class="font-medium text-gray-900">{{ $alumni->industry }}</p>
                    </div>
                @endif
                @if(!$alumni->current_company && !$alumni->current_position && !$alumni->industry)
                    <p class="text-gray-500 text-sm">No career information available.</p>
                @endif
            </div>
        </div>

        <!-- Contact Information -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Contact</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $alumni->user->email }}</p>
                </div>
                @if($alumni->phone)
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-medium text-gray-900">{{ $alumni->phone }}</p>
                    </div>
                @endif
                @if($alumni->city && $alumni->country)
                    <div>
                        <p class="text-sm text-gray-500">Location</p>
                        <p class="font-medium text-gray-900">{{ $alumni->city }}, {{ $alumni->country }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Achievements -->
        @if($alumni->achievements)
            <div class="card">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Achievements</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    @foreach($alumni->achievements as $achievement)
                        <li>{{ $achievement }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Batchmates -->
    @if($batchMates->count() > 0)
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Batchmates</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($batchMates as $batchmate)
                    <a href="{{ route('alumni.show', $batchmate) }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition group">
                        <div class="flex-shrink-0 relative">
                            @if($batchmate->profile_photo)
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full blur opacity-20 group-hover:opacity-30 transition"></div>
                                <img src="{{ $batchmate->profilePhotoUrl }}" alt="{{ $batchmate->user->name }}" class="relative w-12 h-12 rounded-full object-cover border-2 border-white shadow ring-2 ring-primary-100">
                            @else
                                <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white shadow ring-2 ring-primary-50">
                                    <span class="text-lg font-semibold text-primary-600">{{ substr($batchmate->user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $batchmate->user->name }}</p>
                            @if($batchmate->current_company)
                                <p class="text-xs text-gray-500 truncate">{{ $batchmate->current_company }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
