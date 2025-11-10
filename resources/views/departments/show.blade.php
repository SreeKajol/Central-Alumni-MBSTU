@extends('layouts.app')

@section('title', $department->name)
@section('header', $department->name)

@section('content')
<div class="space-y-6">
    <!-- Department Header -->
    <div class="card">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                @if($department->logo)
                    <img src="{{ asset('storage/' . $department->logo) }}" alt="{{ $department->name }}" class="w-20 h-20 rounded-lg object-cover">
                @else
                    <div class="w-20 h-20 rounded-lg bg-primary-100 flex items-center justify-center">
                        <span class="text-3xl font-bold text-primary-600">{{ substr($department->code, 0, 2) }}</span>
                    </div>
                @endif
                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $department->name }}</h1>
                    <p class="text-lg text-gray-600 mt-1">{{ $department->code }}</p>
                    @if($department->description)
                        <p class="mt-3 text-gray-700">{{ $department->description }}</p>
                    @endif
                </div>
            </div>

            @if(auth()->check() && auth()->user()->canManageDepartment($department))
                <a href="{{ route('departments.edit', $department) }}" class="btn btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
            @endif
        </div>

        @if($department->head_name || $department->contact_email || $department->contact_phone)
            <div class="mt-6 pt-6 border-t grid grid-cols-1 md:grid-cols-3 gap-4">
                @if($department->head_name)
                    <div>
                        <p class="text-sm text-gray-500">Department Head</p>
                        <p class="font-medium text-gray-900">{{ $department->head_name }}</p>
                    </div>
                @endif
                @if($department->contact_email)
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <a href="mailto:{{ $department->contact_email }}" class="font-medium text-primary-600 hover:text-primary-800">{{ $department->contact_email }}</a>
                    </div>
                @endif
                @if($department->contact_phone)
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-medium text-gray-900">{{ $department->contact_phone }}</p>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Alumni</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $department->alumniProfiles->count() }}</p>
                </div>
                <svg class="w-12 h-12 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Upcoming Events</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $department->events->count() }}</p>
                </div>
                <svg class="w-12 h-12 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Recent News</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $department->news->count() }}</p>
                </div>
                <svg class="w-12 h-12 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Alumni List -->
    <div class="card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">Department Alumni</h2>
            <a href="{{ route('alumni.index', ['department' => $department->id]) }}" class="text-primary-600 hover:text-primary-800 font-medium">View All →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($department->alumniProfiles->take(6) as $alumni)
                <a href="{{ route('alumni.show', $alumni) }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition">
                    <div class="flex-shrink-0">
                        @if($alumni->profile_photo)
                            <img src="{{ $alumni->profilePhotoUrl }}" alt="{{ $alumni->user->name }}" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-lg font-semibold text-primary-600">{{ substr($alumni->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $alumni->user->name }}</p>
                        <p class="text-xs text-gray-500">Batch {{ $alumni->batch_year }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-gray-500 text-center py-8">No alumni profiles yet.</p>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Upcoming Events -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Upcoming Events</h2>
            <div class="space-y-3">
                @forelse($department->events->take(5) as $event)
                    <a href="{{ route('events.show', $event) }}" class="block p-3 rounded-lg hover:bg-gray-50 transition">
                        <p class="font-medium text-gray-900">{{ $event->title }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $event->event_date->format('M d, Y') }}</p>
                    </a>
                @empty
                    <p class="text-gray-500 text-sm">No upcoming events.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent News -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Recent News</h2>
            <div class="space-y-3">
                @forelse($department->news->take(5) as $news)
                    <a href="{{ route('news.show', $news) }}" class="block p-3 rounded-lg hover:bg-gray-50 transition">
                        <p class="font-medium text-gray-900">{{ $news->title }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $news->published_at->diffForHumans() }}</p>
                    </a>
                @empty
                    <p class="text-gray-500 text-sm">No news articles.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
