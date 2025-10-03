@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('subtitle', 'Overview of your project management activities')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Students Card -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Students</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_students'] }}</p>
                    <p class="text-xs text-green-600 mt-2">+3 this semester</p>
                </div>
                <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-blue-100">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Projects Card -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Active Projects</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_projects'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">+2 this week</p>
                </div>
                <div class="w-14 h-14 rounded-xl flex items-center justify-center" style="background-color: rgba(122, 0, 30, 0.1);">
                    <svg class="w-7 h-7" style="color: #7A001E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Reports Due Card -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Reports Due</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_reports'] }}</p>
                    <p class="text-xs text-orange-600 mt-2">Due this week</p>
                </div>
                <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-orange-100">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Notifications Card -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Notifications</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['unread_notifications'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">3 unread</p>
                </div>
                <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-green-100">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Projects & Upcoming Deadlines -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Projects -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Recent Projects</h3>
                <a href="{{ route('projects.index') }}" class="text-sm font-medium hover:underline" style="color: #7A001E;">View All</a>
            </div>
            <div class="space-y-4">
                @forelse($recentProjects as $project)
                    <div class="flex items-start space-x-4 p-4 rounded-lg hover:bg-gray-50 transition-colors border border-gray-100">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $project->title }}</h4>
                                <span class="ml-2 px-3 py-1 text-xs font-medium rounded-full flex-shrink-0
                                    @if($project->status === 'Completed') bg-green-100 text-green-800
                                    @elseif($project->status === 'In Progress') bg-blue-100 text-blue-800
                                    @elseif($project->status === 'Review') bg-orange-100 text-orange-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $project->status }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 mb-3">{{ $project->student->name }}</p>
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500">Due: {{ $project->end_date->format('Y-m-d') }}</p>
                                <div class="flex items-center">
                                    <div class="w-24 h-2 bg-gray-200 rounded-full mr-2">
                                        <div class="h-2 rounded-full" style="background-color: #7A001E; width: {{ $project->progress }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">{{ $project->progress }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-8">No recent projects</p>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Upcoming Deadlines</h3>
                <a href="{{ route('reports.index') }}" class="text-sm font-medium hover:underline" style="color: #7A001E;">View Reports</a>
            </div>
            <div class="space-y-4">
                @forelse($recentProjects->take(3) as $project)
                    <div class="flex items-start space-x-4 p-4 border-l-4 rounded-r-lg bg-gray-50" style="border-color: #7A001E;">
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">{{ $project->title }}</h4>
                            <p class="text-xs text-gray-600 mb-2">{{ $project->student->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">{{ $project->end_date->format('M d') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-8">No upcoming deadlines</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
