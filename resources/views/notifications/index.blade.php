@extends('layouts.dashboard')

@section('title', 'Notifications')
@section('subtitle', 'Stay updated with project activities and deadlines')

@section('header-actions')
    <button onclick="markAllAsRead()" class="px-5 py-2.5 text-sm font-medium border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
        Mark All as Read
    </button>
    <button class="px-5 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity flex items-center shadow-sm" style="background-color: #7A001E;">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        Settings
    </button>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Unread</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->where('is_read', false)->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Urgent</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->where('type', 'overdue')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Deadlines</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->where('type', 'deadline')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Submissions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->where('type', 'system')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <div class="flex flex-wrap gap-2">
            <button onclick="filterNotifications('all')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors active" style="background-color: #7A001E; color: white;">
                All Notifications
            </button>
            <button onclick="filterNotifications('unread')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Unread
            </button>
            <button onclick="filterNotifications('deadline')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Deadlines
            </button>
            <button onclick="filterNotifications('overdue')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Overdue
            </button>
            <button onclick="filterNotifications('system')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Submissions
            </button>
            <button onclick="filterNotifications('reminder')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Milestones
            </button>
            <button class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Meetings
            </button>
            <button class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                System
            </button>
        </div>
    </div>

    <!-- Notifications List -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-4">All Notifications ({{ $notifications->count() }})</h3>
        
        <div id="notificationsList" class="space-y-4">
            @forelse($notifications as $notification)
                <div class="notification-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all border-l-4 p-6 {{ $notification->is_read ? 'opacity-70' : '' }}"
                     data-type="{{ $notification->type }}"
                     data-read="{{ $notification->is_read ? 'read' : 'unread' }}"
                     style="border-color: 
                        @if($notification->type === 'overdue') #EF4444
                        @elseif($notification->type === 'deadline') #F97316
                        @elseif($notification->type === 'system') #10B981
                        @else #3B82F6
                        @endif;">
                    <div class="flex items-start">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                @if($notification->type === 'deadline') bg-blue-100
                                @elseif($notification->type === 'overdue') bg-red-100
                                @elseif($notification->type === 'reminder') bg-purple-100
                                @else bg-green-100
                                @endif">
                                @if($notification->type === 'deadline')
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif($notification->type === 'overdue')
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="ml-4 flex-1">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-base font-bold text-gray-900 mb-1">
                                        {{ $notification->message }}
                                        @if(!$notification->is_read)
                                            <span class="inline-block w-2 h-2 rounded-full bg-red-500 ml-2"></span>
                                        @endif
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-3">Additional details about the notification can be shown here if needed.</p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($notification->type === 'deadline') bg-yellow-100 text-yellow-800
                                            @elseif($notification->type === 'overdue') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ $notification->type === 'deadline' ? 'high' : ($notification->type === 'overdue' ? 'urgent' : 'normal') }}
                                        </span>
                                        <span class="text-gray-500">David Brown</span>
                                    </div>
                                </div>
                                
                                @if($notification->type === 'deadline')
                                    <button class="ml-4 px-4 py-2 text-sm font-medium border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
                                        View Project
                                    </button>
                                @elseif($notification->type === 'overdue')
                                    <button class="ml-4 px-4 py-2 text-sm font-medium border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
                                        Contact Student
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No notifications</h3>
                    <p class="mt-2 text-sm text-gray-500">You're all caught up! No new notifications at this time.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function filterNotifications(type) {
    const cards = document.querySelectorAll('.notification-card');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update button styles
    buttons.forEach(btn => {
        btn.classList.remove('active');
        btn.style.backgroundColor = '#F3F4F6';
        btn.style.color = '#374151';
    });
    event.target.classList.add('active');
    event.target.style.backgroundColor = '#7A001E';
    event.target.style.color = 'white';
    
    // Filter cards
    cards.forEach(card => {
        const cardType = card.dataset.type;
        const cardRead = card.dataset.read;
        
        if (type === 'all') {
            card.style.display = 'block';
        } else if (type === 'unread') {
            card.style.display = cardRead === 'unread' ? 'block' : 'none';
        } else {
            card.style.display = cardType === type ? 'block' : 'none';
        }
    });
}

function markAllAsRead() {
    if (confirm('Mark all notifications as read?')) {
        alert('This feature requires backend implementation.');
    }
}
</script>
@endsection
