<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NotificationController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all notifications
            $notifications = Notification::with('teacher')->latest()->get();
        } else {
            // Teacher sees only their own notifications
            $teacher = Teacher::where('email', $user->email)->first();
            if ($teacher) {
                $notifications = Notification::where('teacher_id', $teacher->id)->latest()->get();
            } else {
                $notifications = collect();
            }
        }
        
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'type' => 'required|string',
        ]);

        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can create notifications for any teacher
            $validated['teacher_id'] = $request->input('teacher_id');
        } else {
            // Teacher can only create notifications for themselves
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher) {
                abort(403, 'Teacher not found.');
            }
            $validated['teacher_id'] = $teacher->id;
        }
        
        $notification = Notification::create($validated);

        return back()->with('success', 'Notification created successfully.');
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            // Check if notification belongs to authenticated teacher
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || $notification->teacher_id !== $teacher->id) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        $notification->update(['is_read' => true]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Notification marked as read.']);
        }

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark notification as unread.
     */
    public function markAsUnread(Notification $notification)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            // Check if notification belongs to authenticated teacher
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || $notification->teacher_id !== $teacher->id) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        $notification->update(['is_read' => false]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Notification marked as unread.']);
        }

        return back()->with('success', 'Notification marked as unread.');
    }

    /**
     * Mark all notifications as read for the authenticated user.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin can mark all notifications as read
            Notification::query()->update(['is_read' => true]);
        } else {
            // Teacher can only mark their own notifications as read
            $teacher = Teacher::where('email', $user->email)->first();
            if ($teacher) {
                Notification::where('teacher_id', $teacher->id)->update(['is_read' => true]);
            }
        }

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'All notifications marked as read.']);
        }

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            // Check if notification belongs to authenticated teacher
            $teacher = Teacher::where('email', $user->email)->first();
            if (!$teacher || $notification->teacher_id !== $teacher->id) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }
}

