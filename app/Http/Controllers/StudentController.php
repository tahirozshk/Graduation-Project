<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SupervisorGroup;
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
            $students = Student::with('projects', 'teachers')->get();
        } else {
            // Teacher sees only their own students through supervisor groups
            $teacher = Teacher::where('email', $user->email)->first();
            if ($teacher) {
                $students = $teacher->students()->with('projects')->get();
            } else {
                $students = collect();
            }
        }
        
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $teachers = Teacher::all();
        } else {
            $teacher = Teacher::where('email', $user->email)->first();
            $teachers = $teacher ? collect([$teacher]) : collect();
        }
        
        return view('students.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validation rules
        $rules = [
            'student_id' => 'required|unique:students',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'year' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
        
        // Admin can select supervisor, teacher is automatically supervisor
        if ($user->isAdmin()) {
            $rules['teacher_id'] = 'required|exists:teachers,id';
        }
        
        $validated = $request->validate($rules);

        // Remove teacher_id from student creation data
        $studentData = collect($validated)->except('teacher_id')->toArray();
        $student = Student::create($studentData);

        // Determine supervisor
        if ($user->isAdmin()) {
            $supervisorId = $validated['teacher_id'];
        } else {
            // Teacher is automatically the supervisor
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher) {
                abort(403, 'Teacher not found.');
            }
            $supervisorId = $teacher->id;
        }

        // Create supervisor group relationship
        SupervisorGroup::create([
            'teacher_id' => $supervisorId,
            'student_id' => $student->id,
        ]);

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
        if (!$user->isAdmin()) {
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || !$student->teachers->contains($teacher->id)) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        $student->load('projects.reports', 'teachers');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $user = Auth::user();
        
        // Check if student belongs to authenticated teacher (unless admin)
        if (!$user->isAdmin()) {
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || !$student->teachers->contains($teacher->id)) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        if ($user->isAdmin()) {
            $teachers = Teacher::all();
        } else {
            $teacher = Teacher::where('email', $user->email)->first();
            $teachers = $teacher ? collect([$teacher]) : collect();
        }
        
        return view('students.edit', compact('student', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $user = Auth::user();
        
        // Check if student belongs to authenticated teacher (unless admin)
        if (!$user->isAdmin()) {
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || !$student->teachers->contains($teacher->id)) {
                abort(403, 'Unauthorized action.');
            }
        }

        // Validation rules
        $rules = [
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'year' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
        
        // Admin can change supervisor, teacher cannot
        if ($user->isAdmin()) {
            $rules['teacher_id'] = 'required|exists:teachers,id';
        }
        
        $validated = $request->validate($rules);

        // Remove teacher_id from student update data
        $studentData = collect($validated)->except('teacher_id')->toArray();
        $student->update($studentData);

        // Update supervisor group relationship only if admin
        if ($user->isAdmin()) {
            SupervisorGroup::where('student_id', $student->id)->delete();
            SupervisorGroup::create([
                'teacher_id' => $validated['teacher_id'],
                'student_id' => $student->id,
            ]);
        }

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
        if (!$user->isAdmin()) {
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || !$student->teachers->contains($teacher->id)) {
                abort(403, 'Unauthorized action.');
            }
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
        
        // Delete supervisor group relationships first
        SupervisorGroup::where('student_id', $student->id)->delete();
        
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}

