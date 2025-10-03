<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all data
            $stats = [
                'total_students' => \App\Models\Student::count(),
                'active_students' => \App\Models\Student::where('status', 'active')->count(),
                'total_projects' => \App\Models\Project::count(),
                'completed_projects' => \App\Models\Project::where('status', 'Completed')->count(),
                'pending_reports' => \App\Models\Report::where('status', 'Review')->count(),
                'unread_notifications' => $user->notifications()->where('is_read', false)->count(),
            ];

            $recentProjects = \App\Models\Project::with('student')->latest()->take(5)->get();
        } else {
            // Teacher sees only their own data
            $stats = [
                'total_students' => $user->students()->count(),
                'active_students' => $user->students()->where('status', 'active')->count(),
                'total_projects' => $user->students()->withCount('projects')->get()->sum('projects_count'),
                'completed_projects' => 0,
                'pending_reports' => 0,
                'unread_notifications' => $user->notifications()->where('is_read', false)->count(),
            ];

            // Calculate completed projects
            foreach ($user->students as $student) {
                $stats['completed_projects'] += $student->projects()->where('status', 'Completed')->count();
            }

            // Calculate pending reports
            foreach ($user->students as $student) {
                foreach ($student->projects as $project) {
                    $stats['pending_reports'] += $project->reports()->where('status', 'Review')->count();
                }
            }

            $recentProjects = \App\Models\Project::whereHas('student', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with('student')->latest()->take(5)->get();
        }

        $recentNotifications = $user->notifications()->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentProjects', 'recentNotifications'));
    }
}

