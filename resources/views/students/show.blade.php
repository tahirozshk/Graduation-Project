@extends('layouts.dashboard')

@section('title', $student->name)
@section('subtitle', 'Student ID: ' . $student->student_id)

@section('header-actions')
    <a href="{{ route('students.edit', $student) }}" class="px-5 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity flex items-center shadow-sm" style="background-color: #7A001E;">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Student
    </a>
    <a href="{{ route('students.index') }}" class="px-5 py-2.5 border text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
        Back to Students
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Student Info Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-start space-x-6">
            <div class="w-24 h-24 rounded-full flex items-center justify-center text-white text-3xl font-bold" style="background-color: #7A001E;">
                {{ substr($student->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $student->name }}</h2>
                        <p class="text-gray-600">{{ $student->email }}</p>
                    </div>
                    <span class="px-4 py-2 text-sm font-medium rounded-full {{ $student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($student->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Student ID</p>
                        <p class="font-semibold text-gray-900">{{ $student->student_id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Department</p>
                        <p class="font-semibold text-gray-900">{{ $student->department }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Year</p>
                        <p class="font-semibold text-gray-900">{{ $student->year }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Projects</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $student->projects->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Completed Projects</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $student->projects->where('status', 'Completed')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Reports</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $student->projects->sum(function($p) { return $p->reports->count(); }) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Projects</h3>
        @forelse($student->projects as $project)
            <div class="border-l-4 rounded-r-lg p-4 mb-4 hover:bg-gray-50 transition-colors" style="border-color: #7A001E;">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900 mb-1">{{ $project->title }}</h4>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ $project->description }}</p>
                    </div>
                    <span class="ml-4 px-3 py-1 text-xs font-medium rounded-full flex-shrink-0
                        @if($project->status === 'Completed') bg-green-100 text-green-800
                        @elseif($project->status === 'In Progress') bg-blue-100 text-blue-800
                        @elseif($project->status === 'Review') bg-orange-100 text-orange-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $project->status }}
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3 text-sm">
                    <div>
                        <p class="text-gray-600">Type</p>
                        <p class="font-medium text-gray-900">{{ $project->project_type }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Start Date</p>
                        <p class="font-medium text-gray-900">{{ $project->start_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">End Date</p>
                        <p class="font-medium text-gray-900">{{ $project->end_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Reports</p>
                        <p class="font-medium text-gray-900">{{ $project->reports->count() }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex-1 mr-4">
                        <div class="flex items-center mb-1">
                            <span class="text-xs text-gray-600 mr-2">Progress</span>
                            <span class="text-xs font-medium text-gray-900">{{ $project->progress }}%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 rounded-full" style="background-color: #7A001E; width: {{ $project->progress }}%"></div>
                        </div>
                    </div>
                    <a href="{{ route('projects.show', $project) }}" class="px-4 py-2 text-sm border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 py-8">No projects assigned yet</p>
        @endforelse
    </div>
</div>
@endsection
