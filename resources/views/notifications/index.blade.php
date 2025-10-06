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
            <div class="flex items-center justify-between mb-3">
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
            <p class="text-xs text-gray-500">New deadline notifications that require your attention</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Project Deadlines</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->where('type', 'project_deadline')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500">Projects with approaching deadlines (1 week)</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Report Deadlines</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->where('type', 'report_deadline')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500">Reports with approaching submission dates (2 days)</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $notifications->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500">All deadline notifications</p>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <div class="flex flex-wrap gap-2">
            <button onclick="filterNotifications('all')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors active" style="background-color: #7A001E; color: white;">
                All Deadlines
            </button>
            <button onclick="filterNotifications('unread')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Unread
            </button>
            <button onclick="filterNotifications('project_deadline')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Project Deadlines
            </button>
            <button onclick="filterNotifications('report_deadline')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
                Report Deadlines
            </button>
        </div>
    </div>

    <!-- Notifications List -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Deadline Notifications ({{ $notifications->count() }})</h3>
        
        <div id="notificationsList" class="space-y-4">
            @forelse($notifications as $notification)
                <div class="notification-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all border-l-4 p-6 {{ $notification->is_read ? 'opacity-70' : '' }}
                     @if($notification->type === 'project_deadline') border-orange-500
                     @elseif($notification->type === 'report_deadline') border-blue-500
                     @else border-gray-500
                     @endif"
                     data-type="{{ $notification->type }}"
                     data-read="{{ $notification->is_read ? 'read' : 'unread' }}">
                    <div class="flex items-start">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                @if($notification->type === 'project_deadline') bg-orange-100
                                @elseif($notification->type === 'report_deadline') bg-blue-100
                                @else bg-gray-100
                                @endif">
                                @if($notification->type === 'project_deadline')
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                @elseif($notification->type === 'report_deadline')
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="ml-4 flex-1">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="mb-1">
                                        <h4 class="text-base font-bold text-gray-900">
                                            {{ $notification->message }}
                                            @if(!$notification->is_read)
                                                <span class="inline-block w-2 h-2 rounded-full bg-red-500 ml-2"></span>
                                            @endif
                                        </h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Additional details about the notification can be shown here if needed.</p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($notification->type === 'project_deadline') bg-orange-100 text-orange-800
                                            @elseif($notification->type === 'report_deadline') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ $notification->type === 'project_deadline' ? 'project' : ($notification->type === 'report_deadline' ? 'report' : 'normal') }}
                                        </span>
                                        <span class="text-gray-500">David Brown</span>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    @if($notification->type === 'project_deadline')
                                        <button class="px-4 py-2 text-sm font-medium border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
                                            View Project
                                        </button>
                                    @elseif($notification->type === 'report_deadline')
                                        <button class="px-4 py-2 text-sm font-medium border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
                                            View Report
                                        </button>
                                    @endif
                                    <button onclick="toggleNotificationRead({{ $notification->id }})" 
                                            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $notification->is_read ? 'bg-gray-200 text-gray-600' : 'bg-blue-600 text-white hover:bg-blue-700' }}"
                                            id="read-btn-{{ $notification->id }}"
                                            data-read="{{ $notification->is_read ? 'true' : 'false' }}">
                                        {{ $notification->is_read ? 'Read' : 'Read' }}
                                    </button>
                                </div>
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
            // Filter by notification type
            card.style.display = cardType === type ? 'block' : 'none';
        }
    });
    
    // Update the header count to show filtered results
    const visibleCards = Array.from(cards).filter(card => card.style.display !== 'none');
    const header = document.querySelector('h3');
    if (header) {
        if (type === 'all') {
            header.textContent = `All Notifications (${cards.length})`;
        } else if (type === 'unread') {
            const unreadCount = Array.from(cards).filter(card => card.dataset.read === 'unread').length;
            header.textContent = `Unread Notifications (${unreadCount})`;
        } else {
            const typeCount = Array.from(cards).filter(card => card.dataset.type === type).length;
            const typeLabel = type === 'project_deadline' ? 'Project Deadlines' : 
                            (type === 'report_deadline' ? 'Report Deadlines' : 
                            type.charAt(0).toUpperCase() + type.slice(1) + ' Notifications');
            header.textContent = `${typeLabel} (${typeCount})`;
        }
    }
}

function markAllAsRead() {
    if (confirm('Are you sure you want to mark all notifications as read?')) {
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                // Tüm bildirimleri okundu olarak işaretle
                document.querySelectorAll('.notification-card').forEach(card => {
                    card.classList.add('opacity-70');
                    card.dataset.read = 'read';
                    
                    // Kırmızı noktayı kaldır
                    const redDot = card.querySelector('.inline-block.w-2.h-2');
                    if (redDot) {
                        redDot.remove();
                    }
                    
                    // Butonları güncelle
                    const readBtn = card.querySelector('[id^="read-btn-"]');
                    if (readBtn) {
                        readBtn.textContent = 'Read';
                        readBtn.className = 'px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-200 text-gray-600';
                        readBtn.dataset.read = 'true';
                    }
                });
                
                // Başarı mesajı göster
                alert('All notifications marked as read!');
                
                // İstatistikleri güncelle
                updateNotificationStats();
                updateSidebarNotificationCount();
                
            } else {
                alert('An error occurred. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}

function toggleNotificationRead(notificationId) {
    const readBtn = document.getElementById(`read-btn-${notificationId}`);
    const currentReadStatus = readBtn.dataset.read === 'true';
    const newReadStatus = !currentReadStatus;
    const endpoint = `/notifications/${notificationId}/${newReadStatus ? 'read' : 'unread'}`;
    
    console.log('Toggling notification:', notificationId, 'from:', currentReadStatus, 'to:', newReadStatus);
    
    fetch(endpoint, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            // Başarılı - UI'ı güncelle
            const readBtn = document.getElementById(`read-btn-${notificationId}`);
            const card = readBtn.closest('.notification-card');
            
            if (newReadStatus) {
                // Okundu işaretle
                card.classList.add('opacity-70');
                card.dataset.read = 'read';
                
                // Kırmızı noktayı kaldır
                const redDot = card.querySelector('.inline-block.w-2.h-2');
                if (redDot) {
                    redDot.remove();
                }
                
                // Buton güncelle
                readBtn.textContent = 'Read';
                readBtn.className = 'px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-gray-200 text-gray-600';
                readBtn.dataset.read = 'true';
                
                console.log('Notification marked as read');
            } else {
                // Okunmadı işaretle
                card.classList.remove('opacity-70');
                card.dataset.read = 'unread';
                
                // Kırmızı noktayı ekle
                const title = card.querySelector('h4');
                if (title && !title.querySelector('.inline-block.w-2.h-2')) {
                    const redDot = document.createElement('span');
                    redDot.className = 'inline-block w-2 h-2 rounded-full bg-red-500 ml-2';
                    title.appendChild(redDot);
                }
                
                // Buton güncelle
                readBtn.textContent = 'Read';
                readBtn.className = 'px-4 py-2 text-sm font-medium rounded-lg transition-colors bg-blue-600 text-white hover:bg-blue-700';
                readBtn.dataset.read = 'false';
                
                console.log('Notification marked as unread');
            }
            
            // İstatistikleri güncelle
            updateNotificationStats();
            
            // Sol menüdeki notification sayısını güncelle
            updateSidebarNotificationCount();
            
        } else {
            console.log('Error response status:', response.status);
            alert('An error occurred. Status: ' + response.status);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function updateNotificationStats() {
    const cards = document.querySelectorAll('.notification-card');
    const unreadCount = Array.from(cards).filter(card => card.dataset.read === 'unread').length;
    
    // İstatistik kartlarını güncelle (eğer varsa)
    const unreadElement = document.querySelector('.text-2xl.font-bold.text-gray-900');
    if (unreadElement) {
        unreadElement.textContent = unreadCount;
    }
}

function updateSidebarNotificationCount() {
    const cards = document.querySelectorAll('.notification-card');
    const unreadCount = Array.from(cards).filter(card => card.dataset.read === 'unread').length;
    
    // Sol menüdeki notification badge'ini güncelle
    const sidebarNotificationBadge = document.querySelector('.notification-badge');
    if (sidebarNotificationBadge) {
        if (unreadCount > 0) {
            sidebarNotificationBadge.textContent = unreadCount;
            sidebarNotificationBadge.style.display = 'inline-block';
        } else {
            sidebarNotificationBadge.style.display = 'none';
        }
    }
    
    // Menü linkindeki badge'i güncelle
    const menuNotificationBadge = document.querySelector('a[href*="notifications"] span');
    if (menuNotificationBadge) {
        if (unreadCount > 0) {
            menuNotificationBadge.textContent = unreadCount;
            menuNotificationBadge.style.display = 'inline-block';
        } else {
            menuNotificationBadge.style.display = 'none';
        }
    }
}
</script>
@endsection
