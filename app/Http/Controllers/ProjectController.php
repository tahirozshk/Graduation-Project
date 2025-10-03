<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all projects
            $projects = Project::with('student.teacher', 'reports')->get();
        } else {
            // Teacher sees only their students' projects
            $projects = Project::whereHas('student', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with('student', 'reports')->get();
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can create projects for all students
            $students = Student::all();
        } else {
            // Teacher can create projects only for their students
            $students = $user->students;
        }
        
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

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => 'Project',
            'model_name' => $project->title,
            'model_id' => $project->id,
            'description' => "Created project: {$project->title}",
        ]);

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
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can edit any project
            $students = Student::all();
        } else {
            // Teacher can edit only their students' projects
            $students = $user->students;
        }
        
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

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'Project',
            'model_name' => $project->title,
            'model_id' => $project->id,
            'description' => "Updated project: {$project->title}",
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Log this activity before deleting
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => 'Project',
            'model_name' => $project->title,
            'model_id' => $project->id,
            'description' => "Deleted project: {$project->title}",
        ]);
        
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}

