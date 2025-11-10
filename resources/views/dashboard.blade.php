@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="text-primary-100">{{ auth()->user()->role->label() }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-primary-100 text-sm">Total Departments</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['total_departments'] }}</p>
                </div>
                <svg class="w-12 h-12 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-primary-100 text-sm">Total Alumni</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['total_alumni'] }}</p>
                </div>
                <svg class="w-12 h-12 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-primary-100 text-sm">Upcoming Events</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['upcoming_events'] }}</p>
                </div>
                <svg class="w-12 h-12 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-primary-100 text-sm">News Articles</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['total_news'] }}</p>
                </div>
                <svg class="w-12 h-12 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent News -->
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Recent News</h3>
                <a href="{{ route('news.index') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">View All</a>
            </div>
            
            <div class="space-y-4">
                @forelse($recentNews as $news)
                    <div class="flex items-start space-x-3 pb-4 border-b last:border-b-0">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('news.show', $news) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">
                                {{ $news->title }}
                            </a>
                            <p class="text-xs text-gray-500 mt-1">{{ $news->published_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No news articles available.</p>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Upcoming Events</h3>
                <a href="{{ route('events.index') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">View All</a>
            </div>
            
            <div class="space-y-4">
                @forelse($upcomingEvents as $event)
                    <div class="flex items-start space-x-3 pb-4 border-b last:border-b-0">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('events.show', $event) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">
                                {{ $event->title }}
                            </a>
                            <p class="text-xs text-gray-500 mt-1">{{ $event->event_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No upcoming events.</p>
                @endforelse
            </div>
        </div>
    </div>

    @if(auth()->user()->isAlumni() && !auth()->user()->alumniProfile)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        You haven't created your alumni profile yet. 
                        <a href="{{ route('alumni.create') }}" class="font-medium underline hover:text-yellow-600">Create your profile now</a> to connect with other alumni!
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
