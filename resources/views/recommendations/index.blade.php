@extends('layouts.app')

@section('title', 'AI-Powered Recommendations')
@section('header')
    <div class="flex justify-between items-center">
        <span>🤖 AI-Powered Recommendations</span>
        <span class="text-sm text-primary-200">Powered by Java Intelligence Service</span>
    </div>
@endsection

@section('content')
    <div class="space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (!$serviceAvailable)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Alumni Intelligence Service is currently unavailable.</strong><br>
                                Please make sure the Java microservice is running on port 8081.
                                <a href="/analytics/career" class="underline font-semibold">View Analytics Instead</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recommendation Type Tabs -->
            <div class="bg-white shadow-sm rounded-lg mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="loadRecommendations('networking')" 
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                            data-tab="networking">
                            🌐 Networking
                        </button>
                        <button onclick="loadRecommendations('mentorship')" 
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                            data-tab="mentorship">
                            🎓 Find Mentor
                        </button>
                        <button onclick="loadRecommendations('batchmates')" 
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                            data-tab="batchmates">
                            👥 Batchmates
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Recommendations Grid -->
            <div id="recommendations-container">
                @if ($serviceAvailable && count($recommendations) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($recommendations as $rec)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="p-6">
                                    <!-- Alumni Info -->
                                    <div class="flex items-center mb-4">
                                        <img src="{{ $rec['profilePhoto'] ?? asset('images/default-avatar.png') }}" 
                                            alt="{{ $rec['name'] }}"
                                            class="w-16 h-16 rounded-full object-cover mr-4">
                                        <div>
                                            <h3 class="font-bold text-lg text-gray-800">{{ $rec['name'] }}</h3>
                                            <p class="text-sm text-gray-600">{{ $rec['currentPosition'] ?? 'Alumni' }}</p>
                                        </div>
                                    </div>

                                    <!-- Details -->
                                    <div class="space-y-2 mb-4">
                                        @if ($rec['currentCompany'])
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Company:</span> {{ $rec['currentCompany'] }}
                                            </p>
                                        @endif
                                        @if ($rec['industry'])
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Industry:</span> {{ $rec['industry'] }}
                                            </p>
                                        @endif
                                        @if ($rec['batchYear'])
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Batch:</span> {{ $rec['batchYear'] }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Similarity Score -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs text-gray-600">Match Score</span>
                                            <span class="text-xs font-bold text-blue-600">{{ round($rec['similarityScore'] * 100) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $rec['similarityScore'] * 100 }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Recommendation Reason -->
                                    <p class="text-xs text-gray-600 italic mb-4">
                                        {{ $rec['recommendationReason'] }}
                                    </p>

                                    <!-- Action Button -->
                                    <a href="{{ route('alumni.show', $rec['alumniId']) }}" 
                                        class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif ($serviceAvailable)
                    <div class="bg-white shadow-sm rounded-lg p-12 text-center">
                        <p class="text-gray-500">No recommendations available at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentTab = 'networking';

        // Set initial active tab
        document.addEventListener('DOMContentLoaded', function() {
            setActiveTab('networking');
        });

        function setActiveTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            const activeBtn = document.querySelector(`[data-tab="${tab}"]`);
            if (activeBtn) {
                activeBtn.classList.remove('border-transparent', 'text-gray-500');
                activeBtn.classList.add('border-blue-500', 'text-blue-600');
            }
            currentTab = tab;
        }

        function loadRecommendations(type) {
            setActiveTab(type);
            
            const container = document.getElementById('recommendations-container');
            container.innerHTML = '<div class="text-center py-12"><p class="text-gray-500">Loading recommendations...</p></div>';

            fetch(`/recommendations/${type}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        container.innerHTML = '<div class="bg-white shadow-sm rounded-lg p-12 text-center"><p class="text-gray-500">No recommendations found.</p></div>';
                        return;
                    }

                    let html = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
                    data.forEach(rec => {
                        html += createRecommendationCard(rec);
                    });
                    html += '</div>';
                    container.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading recommendations:', error);
                    container.innerHTML = '<div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center"><p class="text-red-600">Error loading recommendations. Please try again.</p></div>';
                });
        }

        function createRecommendationCard(rec) {
            const matchScore = Math.round(rec.similarityScore * 100);
            const photoUrl = rec.profilePhoto || '/images/default-avatar.png';
            
            return `
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <img src="${photoUrl}" alt="${rec.name}" class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">${rec.name}</h3>
                                <p class="text-sm text-gray-600">${rec.currentPosition || 'Alumni'}</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            ${rec.currentCompany ? `<p class="text-sm text-gray-700"><span class="font-semibold">Company:</span> ${rec.currentCompany}</p>` : ''}
                            ${rec.industry ? `<p class="text-sm text-gray-700"><span class="font-semibold">Industry:</span> ${rec.industry}</p>` : ''}
                            ${rec.batchYear ? `<p class="text-sm text-gray-700"><span class="font-semibold">Batch:</span> ${rec.batchYear}</p>` : ''}
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-600">Match Score</span>
                                <span class="text-xs font-bold text-blue-600">${matchScore}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: ${matchScore}%"></div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 italic mb-4">${rec.recommendationReason}</p>
                        <a href="/alumni/${rec.alumniId}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            View Profile
                        </a>
                    </div>
                </div>
            `;
        }
    </script>
@endpush
