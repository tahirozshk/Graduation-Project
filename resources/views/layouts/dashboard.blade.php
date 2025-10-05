<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - NEU PMS Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0 bg-gradient-to-b from-gray-900 to-gray-800 shadow-2xl">
            <div class="h-full flex flex-col">
                <!-- Logo -->
                <div class="flex items-center justify-center px-6 py-6 border-b border-gray-700">
                    <img src="{{ asset('build/assets/ydu-logo.svg') }}" alt="YDU Logo" class="w-32 h-auto object-contain">
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('teachers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('teachers.*') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Teachers
                    </a>
                    @endif
                    
                    <a href="{{ route('students.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('students.*') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Students
                    </a>
                    
                    <a href="{{ route('projects.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('projects.*') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Projects
                    </a>
                    
                    <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Reports
                    </a>
                    
                    <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('notifications.*') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Notifications
                        @php
                            $unreadCount = 0;
                            if (auth()->user()->isAdmin()) {
                                $unreadCount = \App\Models\Notification::where('is_read', false)->count();
                            } else {
                                $teacher = \App\Models\Teacher::where('email', auth()->user()->email)->first();
                                if ($teacher) {
                                    $unreadCount = \App\Models\Notification::where('teacher_id', $teacher->id)->where('is_read', false)->count();
                                }
                            }
                        @endphp
                        @if($unreadCount > 0)
                            <span class="ml-auto bg-red-600 text-white text-xs rounded-full px-2 py-0.5">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                    
                    @if(auth()->user()->isAdmin())
                        <!-- Admin Section Divider -->
                        <div class="px-4 py-2 mt-4">
                            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Admin Panel</div>
                        </div>
                        
                        <a href="{{ route('admin.pending-approvals') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.pending-approvals') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pending Approvals
                            @php
                                $pendingCount = \App\Models\Teacher::where('status', 'pending')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="ml-auto bg-yellow-600 text-white text-xs rounded-full px-2 py-0.5">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.activity-logs') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.activity-logs') ? 'bg-gradient-to-r from-red-900 to-red-800 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Activity Logs
                        </a>
                    @endif
                </nav>
                
                <!-- User Section -->
                <div class="px-4 py-4 border-t border-gray-700">
                    <div class="flex items-center px-3 py-3 rounded-lg bg-gray-700 bg-opacity-50">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-semibold text-sm" style="background-color: #7A001E;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-8 py-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">@yield('title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500 mt-1">@yield('subtitle', 'Welcome back, ' . auth()->user()->name)</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        @yield('header-actions')
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                @if(session('success'))
                    <div class="mb-6 px-4 py-3 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-lg shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 px-4 py-3 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
