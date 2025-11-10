@extends('layouts.app')

@section('title', 'Career Analytics Dashboard')
@section('header', 'Career Analytics Dashboard')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header with Filters -->
            <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Career Analytics Dashboard</h1>
                        <p class="text-sm text-gray-600 mt-1">Track alumni career progression and industry trends</p>
                    </div>
                    
                    <form method="GET" action="{{ route('analytics.career') }}" class="flex gap-3 items-center">
                        <select name="department_id" class="form-select rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors" onchange="this.form.submit()">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ $selectedDepartment == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }} ({{ $dept->code }})
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            @if (empty($localStats['totalAlumni']))
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-yellow-800 font-medium">No alumni data available. Please ensure alumni profiles are completed.</p>
                    </div>
                </div>
            @else
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-xs font-semibold uppercase tracking-wider opacity-90">Total Alumni</p>
                                <p class="text-4xl font-bold mt-2 drop-shadow-md">{{ $localStats['totalAlumni'] ?? 0 }}</p>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-500 via-green-600 to-emerald-700 rounded-xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-xs font-semibold uppercase tracking-wider opacity-90">Verified</p>
                                <p class="text-4xl font-bold mt-2 drop-shadow-md">{{ $localStats['verifiedAlumni'] ?? 0 }}</p>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-500 via-purple-600 to-indigo-700 rounded-xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-xs font-semibold uppercase tracking-wider opacity-90">Employed</p>
                                <p class="text-4xl font-bold mt-2 drop-shadow-md">{{ $localStats['employedAlumni'] ?? 0 }}</p>
                                <p class="text-sm text-white mt-1 opacity-90">{{ $localStats['totalAlumni'] > 0 ? round(($localStats['employedAlumni'] / $localStats['totalAlumni']) * 100, 1) : 0 }}% rate</p>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-orange-500 via-amber-600 to-orange-700 rounded-xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-xs font-semibold uppercase tracking-wider opacity-90">Industries</p>
                                <p class="text-4xl font-bold mt-2 drop-shadow-md">{{ count($localStats['industryBreakdown'] ?? []) }}</p>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-pink-500 via-rose-600 to-pink-700 rounded-xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-xs font-semibold uppercase tracking-wider opacity-90">Public Profiles</p>
                                <p class="text-4xl font-bold mt-2 drop-shadow-md">{{ $localStats['publicProfiles'] ?? 0 }}</p>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Industry Distribution -->
                @if (!empty($localStats['industryBreakdown']) && count($localStats['industryBreakdown']) > 0)
                    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                            Industry Distribution
                        </h3>
                        <div class="space-y-3">
                            @foreach ($localStats['industryBreakdown'] as $industry => $count)
                                @php
                                    $percentage = ($count / $localStats['totalAlumni']) * 100;
                                    $colors = ['bg-gradient-to-r from-blue-500 to-blue-600', 'bg-gradient-to-r from-emerald-500 to-green-600', 'bg-gradient-to-r from-purple-500 to-indigo-600', 'bg-gradient-to-r from-orange-500 to-amber-600', 'bg-gradient-to-r from-pink-500 to-rose-600', 'bg-gradient-to-r from-cyan-500 to-blue-500', 'bg-gradient-to-r from-teal-500 to-emerald-500', 'bg-gradient-to-r from-violet-500 to-purple-500', 'bg-gradient-to-r from-amber-500 to-orange-500', 'bg-gradient-to-r from-red-500 to-pink-500'];
                                    $color = $colors[$loop->index % count($colors)];
                                @endphp
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $industry }}</span>
                                        <span class="text-sm text-gray-600 font-semibold">{{ $count }} ({{ round($percentage, 1) }}%)</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                        <div class="{{ $color }} h-3 rounded-full transition-all duration-700 shadow-sm" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Top Companies -->
                @if (!empty($localStats['topCompanies']) && count($localStats['topCompanies']) > 0)
                    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                            Top Companies Employing Our Alumni
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach ($localStats['topCompanies'] as $company => $count)
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg hover:shadow-lg hover:border-green-300 transition-all duration-300">
                                    <span class="font-semibold text-gray-800 text-sm">{{ $company }}</span>
                                    <span class="bg-gradient-to-r from-green-600 to-emerald-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                        {{ $count }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Top Positions -->
                @if (!empty($localStats['topPositions']) && count($localStats['topPositions']) > 0)
                    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Most Common Job Positions
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($localStats['topPositions'] as $position => $count)
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg hover:shadow-lg hover:border-purple-300 transition-all duration-300">
                                    <span class="font-medium text-gray-700 text-sm">{{ $position }}</span>
                                    <span class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                        {{ $count }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Graduation Year Distribution -->
                    @if (!empty($localStats['graduationDistribution']) && count($localStats['graduationDistribution']) > 0)
                        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                                Graduation Year Trends
                            </h3>
                            <div class="overflow-x-auto">
                                <div class="flex items-end justify-center space-x-3 h-64 pb-6 px-2">
                                    @foreach ($localStats['graduationDistribution'] as $year => $count)
                                        @php
                                            $maxCount = max($localStats['graduationDistribution']->toArray());
                                            $heightPercent = $maxCount > 0 ? ($count / $maxCount) * 100 : 0;
                                            $minHeight = 20; // Minimum 20px height
                                            $actualHeight = max($minHeight, ($heightPercent / 100) * 220); // Max 220px
                                        @endphp
                                        <div class="flex flex-col items-center" style="min-width: 60px;">
                                            <div class="text-sm font-bold text-gray-800 mb-2">{{ $count }}</div>
                                            <div class="w-full bg-gradient-to-t from-indigo-600 via-blue-500 to-blue-400 rounded-t-lg transition-all duration-500 hover:from-indigo-700 hover:via-blue-600 hover:to-blue-500 shadow-lg" style="height: {{ $actualHeight }}px; min-height: 20px;"></div>
                                            <div class="text-xs text-gray-700 mt-3 font-semibold">{{ $year }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- City Distribution -->
                    @if (!empty($localStats['cityDistribution']) && count($localStats['cityDistribution']) > 0)
                        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Top Cities
                            </h3>
                            <div class="space-y-2">
                                @foreach ($localStats['cityDistribution'] as $city => $count)
                                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-orange-50 to-amber-50 border border-orange-200 rounded-lg hover:shadow-md transition-all duration-300">
                                        <span class="text-sm font-medium text-gray-700">{{ $city }}</span>
                                        <span class="bg-gradient-to-r from-orange-600 to-amber-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                            {{ $count }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Country Distribution -->
                @if (!empty($localStats['countryDistribution']) && count($localStats['countryDistribution']) > 0)
                    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                            </svg>
                            Geographic Distribution
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach ($localStats['countryDistribution'] as $country => $count)
                                <div class="text-center p-5 bg-gradient-to-br from-indigo-50 via-blue-50 to-cyan-50 rounded-xl border-2 border-indigo-200 hover:shadow-lg hover:border-indigo-400 transition-all duration-300">
                                    <div class="text-4xl font-extrabold text-indigo-600">{{ $count }}</div>
                                    <div class="text-sm text-gray-800 mt-2 font-bold">{{ $country }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
