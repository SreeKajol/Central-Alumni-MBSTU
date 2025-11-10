<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlumniIntelligenceService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.alumni_intelligence.url', 'http://localhost:8081/api');
    }

    /**
     * Get personalized recommendations for an alumni
     */
    public function getRecommendations(int $alumniId, int $maxResults = 10, string $type = 'networking'): array
    {
        try {
            $response = Http::timeout(10)->post("{$this->baseUrl}/recommendations", [
                'alumniId' => $alumniId,
                'maxResults' => $maxResults,
                'recommendationType' => $type,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('Failed to get recommendations from Java service', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('Error calling Alumni Intelligence Service', [
                'message' => $e->getMessage(),
                'alumni_id' => $alumniId,
            ]);

            return [];
        }
    }

    /**
     * Get networking suggestions
     */
    public function getNetworkingSuggestions(int $alumniId, int $maxResults = 10): array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/recommendations/{$alumniId}/networking", [
                'maxResults' => $maxResults,
            ]);

            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('Error getting networking suggestions', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Get mentorship matches
     */
    public function getMentorshipMatches(int $alumniId, int $maxResults = 10): array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/recommendations/{$alumniId}/mentorship", [
                'maxResults' => $maxResults,
            ]);

            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('Error getting mentorship matches', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Get batchmate recommendations
     */
    public function getBatchmates(int $alumniId, int $maxResults = 10): array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/recommendations/{$alumniId}/batchmates", [
                'maxResults' => $maxResults,
            ]);

            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('Error getting batchmates', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Get career analytics
     */
    public function getCareerAnalytics(?int $departmentId = null): array
    {
        try {
            $url = "{$this->baseUrl}/analytics/career";
            $params = $departmentId ? ['departmentId' => $departmentId] : [];

            $response = Http::timeout(10)->get($url, $params);

            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('Error getting career analytics', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Get industry insights
     */
    public function getIndustryInsights(string $industry): array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/analytics/industry/{$industry}");

            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('Error getting industry insights', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Check if the Java service is available
     */
    public function isServiceAvailable(): bool
    {
        try {
            $response = Http::timeout(3)->get("{$this->baseUrl}/recommendations/health");
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
