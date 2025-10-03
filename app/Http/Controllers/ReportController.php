<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Project;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all reports
            $reports = Report::with('project.student.teacher')->get();
        } else {
            // Teacher sees only reports from their students' projects
            $reports = Report::whereHas('project.student', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with('project.student')->get();
        }

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can create reports for all projects
            $projects = Project::with('student')->get();
        } else {
            // Teacher can create reports only for their students' projects
            $projects = Project::whereHas('student', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with('student')->get();
        }

        return view('reports.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'week_number' => 'required|integer|min:1',
            'content' => 'required|string',
            'submission_date' => 'required|date',
            'status' => 'required|in:Submitted,Review,Overdue',
            'grade' => 'nullable|string',
        ]);

        $report = Report::create($validated);

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => 'Report',
            'model_name' => "Week {$report->week_number} Report",
            'model_id' => $report->id,
            'description' => "Created report for week {$report->week_number}",
        ]);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        $report->load('project.student');
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can edit any report
            $projects = Project::with('student')->get();
        } else {
            // Teacher can edit only reports from their students' projects
            $projects = Project::whereHas('student', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with('student')->get();
        }

        return view('reports.edit', compact('report', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'week_number' => 'required|integer|min:1',
            'content' => 'required|string',
            'submission_date' => 'required|date',
            'status' => 'required|in:Submitted,Review,Overdue',
            'grade' => 'nullable|string',
        ]);

        $report->update($validated);

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'Report',
            'model_name' => "Week {$report->week_number} Report",
            'model_id' => $report->id,
            'description' => "Updated report for week {$report->week_number}",
        ]);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        // Log this activity before deleting
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => 'Report',
            'model_name' => "Week {$report->week_number} Report",
            'model_id' => $report->id,
            'description' => "Deleted report for week {$report->week_number}",
        ]);
        
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}

