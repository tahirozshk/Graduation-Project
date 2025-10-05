<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingApprovalController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware will be applied at route level
    }

    /**
     * Display pending approvals.
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $pendingTeachers = Teacher::where('status', 'pending')
            ->with('approver')
            ->get();

        return view('admin.pending-approvals', compact('pendingTeachers'));
    }

    /**
     * Approve a user.
     */
    public function approveUser(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $user->update([
            'status' => 'active',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        // If user is teacher, also approve teacher record
        if ($user->role === 'teacher') {
            $teacher = Teacher::where('email', $user->email)->first();
            if ($teacher) {
                $teacher->update([
                    'status' => 'active',
                    'approved_at' => now(),
                    'approved_by' => Auth::id(),
                ]);
            }
        }

        return back()->with('success', 'User approved successfully.');
    }

    /**
     * Approve a teacher.
     */
    public function approveTeacher(Teacher $teacher)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $teacher->update([
            'status' => 'active',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        // Also approve corresponding user record
        $user = User::where('email', $teacher->email)->first();
        if ($user) {
            $user->update([
                'status' => 'active',
                'approved_at' => now(),
                'approved_by' => Auth::id(),
            ]);
        }

        return back()->with('success', 'Teacher approved successfully.');
    }

    /**
     * Reject a user.
     */
    public function rejectUser(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $user->update([
            'status' => 'suspended',
            'approved_at' => null,
            'approved_by' => Auth::id(),
        ]);

        // If user is teacher, also reject teacher record
        if ($user->role === 'teacher') {
            $teacher = Teacher::where('email', $user->email)->first();
            if ($teacher) {
                $teacher->update([
                    'status' => 'suspended',
                    'approved_at' => null,
                    'approved_by' => Auth::id(),
                ]);
            }
        }

        return back()->with('success', 'User rejected successfully.');
    }

    /**
     * Reject a teacher.
     */
    public function rejectTeacher(Teacher $teacher)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $teacher->update([
            'status' => 'suspended',
            'approved_at' => null,
            'approved_by' => Auth::id(),
        ]);

        // Also reject corresponding user record
        $user = User::where('email', $teacher->email)->first();
        if ($user) {
            $user->update([
                'status' => 'suspended',
                'approved_at' => null,
                'approved_by' => Auth::id(),
            ]);
        }

        return back()->with('success', 'Teacher rejected successfully.');
    }
}