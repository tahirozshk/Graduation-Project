<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
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
                'total_teachers' => \App\Models\Teacher::count(),
                'total_students' => \App\Models\Student::count(),
                'active_students' => \App\Models\Student::where('status', 'active')->count(),
                'total_projects' => \App\Models\Project::count(),
                'completed_projects' => \App\Models\Project::where('status', 'Completed')->count(),
                'pending_reports' => \App\Models\Report::where('status', 'Review')->count(),
                'unread_notifications' => \App\Models\Notification::where('is_read', false)->count(),
            ];

            $recentProjects = \App\Models\Project::with('students')->latest()->take(5)->get();
        } else {
            // Teacher sees only their own data
            $teacher = Teacher::where('email', $user->email)->first();
            
            if ($teacher) {
                $studentIds = $teacher->students()->pluck('students.id');
                
                $stats = [
                    'total_teachers' => 1,
                    'total_students' => $teacher->students()->count(),
                    'active_students' => $teacher->students()->where('status', 'active')->count(),
                    'total_projects' => \App\Models\Project::whereHas('students', function ($query) use ($studentIds) {
                        $query->whereIn('students.id', $studentIds);
                    })->count(),
                    'completed_projects' => \App\Models\Project::whereHas('students', function ($query) use ($studentIds) {
                        $query->whereIn('students.id', $studentIds);
                    })->where('status', 'Completed')->count(),
                    'pending_reports' => \App\Models\Report::whereHas('project.students', function ($query) use ($studentIds) {
                        $query->whereIn('students.id', $studentIds);
                    })->where('status', 'Review')->count(),
                    'unread_notifications' => \App\Models\Notification::where('teacher_id', $teacher->id)->where('is_read', false)->count(),
                ];

                $recentProjects = \App\Models\Project::whereHas('students', function ($query) use ($studentIds) {
                    $query->whereIn('students.id', $studentIds);
                })->with('students')->latest()->take(5)->get();
                
                $recentNotifications = \App\Models\Notification::where('teacher_id', $teacher->id)->latest()->take(5)->get();
            } else {
                // Fallback for users without teacher record
                $stats = [
                    'total_teachers' => 0,
                    'total_students' => 0,
                    'active_students' => 0,
                    'total_projects' => 0,
                    'completed_projects' => 0,
                    'pending_reports' => 0,
                    'unread_notifications' => 0,
                ];
                
                $recentProjects = collect();
                $recentNotifications = collect();
            }
        }

        if ($user->isAdmin()) {
            $recentNotifications = \App\Models\Notification::latest()->take(5)->get();
        }

        return view('dashboard', compact('stats', 'recentProjects', 'recentNotifications'));
    }
}

