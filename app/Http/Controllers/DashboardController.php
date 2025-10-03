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
        $teacher = Auth::user();
        
        $stats = [
            'total_students' => $teacher->students()->count(),
            'active_students' => $teacher->students()->where('status', 'active')->count(),
            'total_projects' => $teacher->students()->withCount('projects')->get()->sum('projects_count'),
            'completed_projects' => 0,
            'pending_reports' => 0,
            'unread_notifications' => $teacher->notifications()->where('is_read', false)->count(),
        ];

        // Calculate completed projects
        foreach ($teacher->students as $student) {
            $stats['completed_projects'] += $student->projects()->where('status', 'Completed')->count();
        }

        // Calculate pending reports
        foreach ($teacher->students as $student) {
            foreach ($student->projects as $project) {
                $stats['pending_reports'] += $project->reports()->where('status', 'Review')->count();
            }
        }

        $recentProjects = \App\Models\Project::whereHas('student', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->with('student')->latest()->take(5)->get();

        $recentNotifications = $teacher->notifications()->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentProjects', 'recentNotifications'));
    }
}

