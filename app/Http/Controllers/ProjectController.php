<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::whereHas('student', function ($query) {
            $query->where('teacher_id', Auth::id());
        })->with('student', 'reports')->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Auth::user()->students;
        return view('projects.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|in:Research,Development',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'progress' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Planning,In Progress,Review,Completed',
        ]);

        $project = Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('student', 'reports');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $students = Auth::user()->students;
        return view('projects.edit', compact('project', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|in:Research,Development',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'progress' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Planning,In Progress,Review,Completed',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}

