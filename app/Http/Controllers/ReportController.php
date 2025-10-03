<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::whereHas('project.student', function ($query) {
            $query->where('teacher_id', Auth::id());
        })->with('project.student')->get();

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::whereHas('student', function ($query) {
            $query->where('teacher_id', Auth::id());
        })->with('student')->get();

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
        $projects = Project::whereHas('student', function ($query) {
            $query->where('teacher_id', Auth::id());
        })->with('student')->get();

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

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}

