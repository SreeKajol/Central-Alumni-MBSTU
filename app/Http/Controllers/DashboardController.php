<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'total_departments' => Department::count(),
            'total_alumni' => AlumniProfile::count(),
            'upcoming_events' => Event::where('event_date', '>=', now())->count(),
            'total_news' => News::published()->count(),
        ];

        // Role-specific data
        if ($user->isSuperAdmin()) {
            $stats['total_users'] = User::count();
            $stats['pending_verifications'] = AlumniProfile::where('is_verified', false)->count();
        } elseif ($user->isDepartmentAdmin()) {
            $stats['department_alumni'] = AlumniProfile::where('department_id', $user->department_id)->count();
            $stats['department_events'] = Event::where('department_id', $user->department_id)->count();
        }

        $recentNews = News::published()
            ->latest('published_at')
            ->take(5)
            ->get();

        $upcomingEvents = Event::where('event_date', '>=', now())
            ->where('is_active', true)
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentNews', 'upcomingEvents'));
    }
}
