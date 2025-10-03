<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all students
            $students = Student::with('projects', 'teacher')->get();
        } else {
            // Teacher sees only their own students
            $students = $user->students()->with('projects')->get();
        }
        
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'year' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['teacher_id'] = Auth::id();
        $student = Student::create($validated);

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => 'Student',
            'model_name' => $student->name,
            'model_id' => $student->id,
            'description' => "Created student: {$student->name} ({$student->student_id})",
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $user = Auth::user();
        
        // Check if student belongs to authenticated teacher (unless admin)
        if (!$user->isAdmin() && $student->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        
        $student->load('projects.reports', 'teacher');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $user = Auth::user();
        
        // Check if student belongs to authenticated teacher (unless admin)
        if (!$user->isAdmin() && $student->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $user = Auth::user();
        
        // Check if student belongs to authenticated teacher (unless admin)
        if (!$user->isAdmin() && $student->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'year' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $student->update($validated);

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'Student',
            'model_name' => $student->name,
            'model_id' => $student->id,
            'description' => "Updated student: {$student->name}",
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $user = Auth::user();
        
        // Check if student belongs to authenticated teacher (unless admin)
        if (!$user->isAdmin() && $student->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Log this activity before deleting
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => 'Student',
            'model_name' => $student->name,
            'model_id' => $student->id,
            'description' => "Deleted student: {$student->name}",
        ]);
        
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}

