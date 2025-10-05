<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Constructor boş bırakıyoruz, middleware'i route'larda tanımlayacağız
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $teachers = Teacher::with('students')->get();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|string|min:8',
        ]);

        $teacher = Teacher::create($validated);

        // Also create user record for authentication
        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'teacher',
            'status' => 'active',
        ]);

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => 'Teacher',
            'model_name' => $teacher->name,
            'model_id' => $teacher->id,
            'description' => "Created teacher: {$teacher->name}",
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $teacher->load('students.projects');
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'password' => 'nullable|string|min:8',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $teacher->update($validated);

        // Also update user record
        $user = \App\Models\User::where('email', $teacher->email)->first();
        if ($user) {
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];
            if (!empty($validated['password'])) {
                $userData['password'] = $validated['password'];
            }
            $user->update($userData);
        }

        // Log this activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'Teacher',
            'model_name' => $teacher->name,
            'model_id' => $teacher->id,
            'description' => "Updated teacher: {$teacher->name}",
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Log this activity before deleting
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => 'Teacher',
            'model_name' => $teacher->name,
            'model_id' => $teacher->id,
            'description' => "Deleted teacher: {$teacher->name}",
        ]);

        // Delete user record
        $user = \App\Models\User::where('email', $teacher->email)->first();
        if ($user) {
            $user->delete();
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
