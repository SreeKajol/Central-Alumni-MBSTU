@extends('layouts.app')

@section('title', 'Events')
@section('header', 'Events & Reunions')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">University Events</h2>
        @if(auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isDepartmentAdmin()))
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Event
            </a>
        @endif
    </div>

    <!-- Upcoming Events -->
    <div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Upcoming Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($upcomingEvents as $event)
                <div class="event-card">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-2">
                            @if($event->department)
                                <span class="badge badge-primary">{{ $event->department->code }}</span>
                            @else
                                <span class="badge badge-success">University-wide</span>
                            @endif
                            @if($event->event_type)
                                <span class="badge badge-secondary">{{ ucfirst($event->event_type) }}</span>
                            @endif
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $event->event_date->format('F d, Y') }}
                            </div>
                            @if($event->location)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                    {{ $event->location }}
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary w-full">View Details</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 card">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-600">No upcoming events.</p>
                </div>
            @endforelse
        </div>

        @if($upcomingEvents->hasPages())
            <div class="mt-6">{{ $upcomingEvents->links() }}</div>
        @endif
    </div>

    <!-- Past Events -->
    <div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Past Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pastEvents as $event)
                <div class="event-card opacity-75">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover grayscale">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $event->event_date->format('F d, Y') }}</p>
                        <a href="{{ route('events.show', $event) }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium mt-3 inline-block">View Details →</a>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500 text-center py-8">No past events.</p>
            @endforelse
        </div>

        @if($pastEvents->hasPages())
            <div class="mt-6">{{ $pastEvents->links() }}</div>
        @endif
    </div>
</div>
@endsection
