@extends('layouts.app')

@section('title', 'Alumni Directory')
@section('header', 'Alumni Directory')

@section('content')
<div class="space-y-6">
    <!-- Search & Filters -->
    <div class="card">
        <form method="GET" action="{{ route('alumni.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="form-label">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." class="form-input">
                </div>
                
                <div>
                    <label class="form-label">Department</label>
                    <select name="department" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Batch Year</label>
                    <select name="batch_year" class="form-select">
                        <option value="">All Batches</option>
                        @foreach($batchYears as $year)
                            <option value="{{ $year }}" {{ request('batch_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Industry</label>
                    <input type="text" name="industry" value="{{ request('industry') }}" placeholder="e.g., Technology" class="form-input">
                </div>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
                <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Clear Filters</a>
            </div>
        </form>
    </div>

    <!-- Alumni Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($alumni as $alum)
            <div class="alumni-card">
                <a href="{{ route('alumni.show', $alum) }}" class="block p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="relative flex-shrink-0">
                            @if($alum->profile_photo)
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full blur opacity-20"></div>
                                <img src="{{ $alum->profilePhotoUrl }}" alt="{{ $alum->user->name }}" class="relative w-16 h-16 rounded-full object-cover border-2 border-white shadow-lg ring-2 ring-primary-100">
                            @else
                                <div class="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white shadow-lg ring-2 ring-primary-50">
                                    <span class="text-2xl font-bold text-primary-600">{{ substr($alum->user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $alum->user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $alum->department->code }}</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @if($alum->current_position && $alum->current_company)
                            <div class="flex items-start text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $alum->current_position }} at {{ $alum->current_company }}</span>
                            </div>
                        @endif

                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Batch {{ $alum->batch_year }} • {{ $alum->degree }}
                        </div>

                        @if($alum->city && $alum->country)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $alum->city }}, {{ $alum->country }}
                            </div>
                        @endif
                    </div>

                    @if($alum->is_verified)
                        <div class="mt-4">
                            <span class="badge badge-success">✓ Verified</span>
                        </div>
                    @endif
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-12 card">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="mt-4 text-gray-600">No alumni found matching your criteria.</p>
            </div>
        @endforelse
    </div>

    @if($alumni->hasPages())
        <div class="mt-6">
            {{ $alumni->links() }}
        </div>
    @endif
</div>
@endsection
