@extends('layouts.app')

@section('title', $event->title)
@section('header', 'Event Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="card">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-t-lg">
        @endif

        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        @if($event->department)
                            <span class="badge badge-primary">{{ $event->department->name }}</span>
                        @else
                            <span class="badge badge-success">University-wide</span>
                        @endif
                        @if($event->event_type)
                            <span class="badge badge-secondary">{{ ucfirst($event->event_type) }}</span>
                        @endif
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>
                </div>

                @can('update', $event)
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-secondary">Edit</a>
                @endcan
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 pb-6 border-b">
                <div class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Date</p>
                        <p class="font-medium">{{ $event->event_date->format('F d, Y') }}</p>
                    </div>
                </div>

                @if($event->event_time)
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Time</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</p>
                        </div>
                    </div>
                @endif

                @if($event->location)
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Location</p>
                            <p class="font-medium">{{ $event->location }}</p>
                        </div>
                    </div>
                @endif

                @if($event->max_participants)
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Capacity</p>
                            <p class="font-medium">{{ $event->registrationCount }} / {{ $event->max_participants }}</p>
                        </div>
                    </div>
                @endif
            </div>

            @if($event->description)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">About This Event</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $event->description }}</p>
                </div>
            @endif

            @if($event->venue)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Venue</h3>
                    <p class="text-gray-700">{{ $event->venue }}</p>
                </div>
            @endif

            @auth
                @if($event->event_date->isFuture())
                    @if($isRegistered)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-green-800">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    You are registered for this event
                                </div>
                                <form method="POST" action="{{ route('events.unregister', $event) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary">Unregister</button>
                                </form>
                            </div>
                        </div>
                    @else
                        @if($event->isRegistrationOpen() && $event->hasAvailableSlots())
                            <form method="POST" action="{{ route('events.register', $event) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full">Register for This Event</button>
                            </form>
                        @elseif(!$event->hasAvailableSlots())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-red-800">
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    This event is fully booked
                                </p>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-yellow-800">
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    Registration has closed for this event
                                </p>
                            </div>
                        @endif
                    @endif
                @endif
            @endauth

            @guest
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-blue-800">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Please <a href="{{ route('login') }}" class="underline font-medium">login</a> to register for this event
                    </p>
                </div>
            @endguest
        </div>
    </div>

    @if($event->registrations->count() > 0)
        <div class="card">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Registered Participants ({{ $event->registrationCount }})</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($event->registrations->take(12) as $participant)
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                            <span class="text-sm font-semibold text-primary-600">{{ substr($participant->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm text-gray-700 truncate">{{ $participant->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
