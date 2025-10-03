<?php

namespace App\Http\Controllers;

use App\Models\Notification;
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
        $notifications = Auth::user()->notifications()->latest()->get();
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

        $validated['teacher_id'] = Auth::id();
        $notification = Notification::create($validated);

        return back()->with('success', 'Notification created successfully.');
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        // Check if notification belongs to authenticated teacher
        if ($notification->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $notification->update(['is_read' => true]);

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        // Check if notification belongs to authenticated teacher
        if ($notification->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }
}

