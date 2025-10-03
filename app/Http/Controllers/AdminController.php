<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show pending admin approvals
     */
    public function pendingApprovals()
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $pendingUsers = User::where('status', 'pending')
            ->where('role', 'admin')
            ->latest()
            ->get();

        return view('admin.pending-approvals', compact('pendingUsers'));
    }

    /**
     * Approve a pending admin
     */
    public function approveUser($id)
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        
        if ($user->status !== 'pending') {
            return redirect()->back()->with('error', 'User is not pending approval.');
        }

        $user->update(['status' => 'active']);

        // Log this action
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'approved',
            'model' => 'User',
            'model_name' => $user->name,
            'model_id' => $user->id,
            'description' => "Approved admin registration for {$user->name}",
        ]);

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    /**
     * Reject a pending admin
     */
    public function rejectUser($id)
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        
        if ($user->status !== 'pending') {
            return redirect()->back()->with('error', 'User is not pending approval.');
        }

        // Log this action before deleting
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'rejected',
            'model' => 'User',
            'model_name' => $user->name,
            'model_id' => $user->id,
            'description' => "Rejected admin registration for {$user->name}",
        ]);

        $user->delete();

        return redirect()->back()->with('success', 'User rejected and deleted successfully.');
    }

    /**
     * Show activity logs
     */
    public function activityLogs()
    {
        // Only admin can access
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(50);

        return view('admin.activity-logs', compact('logs'));
    }
}