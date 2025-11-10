<?php

namespace App\Http\Controllers;

use App\Models\AlumniProfile;
use App\Models\Department;
use App\Services\AlumniIntelligenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    private AlumniIntelligenceService $intelligenceService;

    public function __construct(AlumniIntelligenceService $intelligenceService)
    {
        $this->middleware('auth');
        $this->intelligenceService = $intelligenceService;
    }

    /**
     * Display recommendations page
     */
    public function index()
    {
        $user = Auth::user();
        $alumniProfile = AlumniProfile::where('user_id', $user->id)->first();

        if (!$alumniProfile) {
            return redirect()->route('alumni.create')
                ->with('error', 'Please create your alumni profile first to get recommendations.');
        }

        // Check if Java service is available
        $serviceAvailable = $this->intelligenceService->isServiceAvailable();

        if (!$serviceAvailable) {
            return view('recommendations.index', [
                'serviceAvailable' => false,
                'recommendations' => [],
            ]);
        }

        // Get default networking recommendations
        $recommendations = $this->intelligenceService->getNetworkingSuggestions($alumniProfile->id);

        return view('recommendations.index', [
            'serviceAvailable' => true,
            'recommendations' => $recommendations,
            'alumniProfile' => $alumniProfile,
        ]);
    }

    /**
     * Get networking suggestions (AJAX)
     */
    public function networking(Request $request)
    {
        $user = Auth::user();
        $alumniProfile = AlumniProfile::where('user_id', $user->id)->first();

        if (!$alumniProfile) {
            return response()->json(['error' => 'Alumni profile not found'], 404);
        }

        $recommendations = $this->intelligenceService->getNetworkingSuggestions(
            $alumniProfile->id,
            $request->input('maxResults', 10)
        );

        return response()->json($recommendations);
    }

    /**
     * Get mentorship matches (AJAX)
     */
    public function mentorship(Request $request)
    {
        $user = Auth::user();
        $alumniProfile = AlumniProfile::where('user_id', $user->id)->first();

        if (!$alumniProfile) {
            return response()->json(['error' => 'Alumni profile not found'], 404);
        }

        $recommendations = $this->intelligenceService->getMentorshipMatches(
            $alumniProfile->id,
            $request->input('maxResults', 10)
        );

        return response()->json($recommendations);
    }

    /**
     * Get batchmates (AJAX)
     */
    public function batchmates(Request $request)
    {
        $user = Auth::user();
        $alumniProfile = AlumniProfile::where('user_id', $user->id)->first();

        if (!$alumniProfile) {
            return response()->json(['error' => 'Alumni profile not found'], 404);
        }

        $recommendations = $this->intelligenceService->getBatchmates(
            $alumniProfile->id,
            $request->input('maxResults', 10)
        );

        return response()->json($recommendations);
    }

    /**
     * Get career analytics
     */
    public function analytics(Request $request)
    {
        $departmentId = $request->input('department_id');
        
        // Get analytics from Java microservice
        $analytics = $this->intelligenceService->getCareerAnalytics($departmentId);
        
        // Get local database statistics
        $query = AlumniProfile::with(['user', 'department'])
            ->where('is_verified', true);
        
        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }
        
        $alumniProfiles = $query->get();
        
        // Calculate additional statistics
        $localStats = [
            'totalAlumni' => $alumniProfiles->count(),
            'verifiedAlumni' => $alumniProfiles->where('is_verified', true)->count(),
            'publicProfiles' => $alumniProfiles->where('is_profile_public', true)->count(),
            'employedAlumni' => $alumniProfiles->whereNotNull('current_company')->count(),
            'industryBreakdown' => $alumniProfiles->whereNotNull('industry')
                ->groupBy('industry')
                ->map->count()
                ->sortDesc()
                ->take(10),
            'topCompanies' => $alumniProfiles->whereNotNull('current_company')
                ->groupBy('current_company')
                ->map->count()
                ->sortDesc()
                ->take(15),
            'topPositions' => $alumniProfiles->whereNotNull('current_position')
                ->groupBy('current_position')
                ->map->count()
                ->sortDesc()
                ->take(10),
            'batchDistribution' => $alumniProfiles->groupBy('batch_year')
                ->map->count()
                ->sortKeys(),
            'graduationDistribution' => $alumniProfiles->groupBy('graduation_year')
                ->map->count()
                ->sortKeys(),
            'cityDistribution' => $alumniProfiles->whereNotNull('city')
                ->groupBy('city')
                ->map->count()
                ->sortDesc()
                ->take(10),
            'countryDistribution' => $alumniProfiles->whereNotNull('country')
                ->groupBy('country')
                ->map->count()
                ->sortDesc(),
        ];
        
        // Get all departments for filter
        $departments = Department::orderBy('name')->get();
        
        // Merge analytics with local stats (local stats take priority if Java service is down)
        if (empty($analytics)) {
            $analytics = $localStats;
        }
        
        return view('recommendations.analytics', [
            'analytics' => $analytics,
            'localStats' => $localStats,
            'departments' => $departments,
            'selectedDepartment' => $departmentId,
        ]);
    }
}
