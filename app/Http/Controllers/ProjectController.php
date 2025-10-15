<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ProjectGroup;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            $projects = Project::with('students.teachers', 'reports')->get();
        } else {
            // Teacher sees only their students' projects
            $teacher = Teacher::where('email', $user->email)->first();
            if ($teacher) {
                $studentIds = $teacher->students()->pluck('students.id');
                $projects = Project::whereHas('students', function ($query) use ($studentIds) {
                    $query->whereIn('students.id', $studentIds);
                })->with('students', 'reports')->get();
            } else {
                $projects = collect();
            }
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
            $teacher = Teacher::where('email', $user->email)->first();
            $students = $teacher ? $teacher->students : collect();
        }
        
        return view('projects.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'exists:students,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|in:Internship I,Internship II,Graduation I,Graduation II',
            'semester' => 'required|in:Fall,Spring,Summer School',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'progress' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Planning,In Progress,Review,Completed',
        ]);

        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'project_type' => $validated['project_type'],
            'semester' => $validated['semester'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'progress' => $validated['progress'] ?? 0,
            'status' => $validated['status'],
        ]);

        // Create project group relationships
        foreach ($validated['student_ids'] as $index => $studentId) {
            ProjectGroup::create([
                'project_id' => $project->id,
                'student_id' => $studentId,
                'role' => $index === 0 ? 'Leader' : 'Member', // First student is leader
            ]);
        }

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
        $project->load('students.teachers', 'reports');
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
            $teacher = Teacher::where('email', $user->email)->first();
            $students = $teacher ? $teacher->students : collect();
        }
        
        return view('projects.edit', compact('project', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'exists:students,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|in:Internship I,Internship II,Graduation I,Graduation II',
            'semester' => 'required|in:Fall,Spring,Summer School',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'progress' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Planning,In Progress,Review,Completed',
        ]);

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'project_type' => $validated['project_type'],
            'semester' => $validated['semester'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'progress' => $validated['progress'] ?? 0,
            'status' => $validated['status'],
        ]);

        // Update project group relationships
        ProjectGroup::where('project_id', $project->id)->delete();
        foreach ($validated['student_ids'] as $index => $studentId) {
            ProjectGroup::create([
                'project_id' => $project->id,
                'student_id' => $studentId,
                'role' => $index === 0 ? 'Leader' : 'Member',
            ]);
        }

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
        
        // Delete project group relationships first
        ProjectGroup::where('project_id', $project->id)->delete();
        
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    /**
     * Submit project file.
     */
    public function submitProject(Request $request, Project $project)
    {
        $request->validate([
            'project_file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        // Delete old file if exists
        if ($project->project_file) {
            Storage::disk('public')->delete($project->project_file);
        }

        // Store new file
        $path = $request->file('project_file')->store("projects/{$project->id}", 'public');

        // Update project with file info
        $project->update([
            'project_file' => $path,
            'file_uploaded_at' => now(),
        ]);

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'file_uploaded',
            'model' => 'Project',
            'model_name' => $project->title,
            'model_id' => $project->id,
            'description' => "Uploaded project file for: {$project->title}",
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project file uploaded successfully.');
    }
}

