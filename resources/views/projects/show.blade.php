@extends('layouts.dashboard')

@section('title', $project->title)
@section('subtitle', 'Project Details')

@section('header-actions')
    <a href="{{ route('projects.edit', $project) }}" class="px-5 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity flex items-center shadow-sm" style="background-color: #7A001E;">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Project
    </a>
    <a href="{{ route('projects.index') }}" class="px-5 py-2.5 border text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
        Back to Projects
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Project Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $project->title }}</h2>
                <p class="text-gray-600">{{ $project->description }}</p>
            </div>
            <span class="px-4 py-2 text-sm font-medium rounded-full
                @if($project->status === 'Completed') bg-green-100 text-green-800
                @elseif($project->status === 'In Progress') bg-blue-100 text-blue-800
                @elseif($project->status === 'Review') bg-orange-100 text-orange-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ $project->status }}
            </span>
        </div>

        <!-- Student Info -->
        @if($project->students->count() > 0)
            @foreach($project->students as $student)
                <div class="flex items-center p-4 bg-gray-50 rounded-lg mb-2">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-semibold" style="background-color: #7A001E;">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                        <p class="text-sm text-gray-600">{{ $student->student_id }} • {{ $student->department }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-semibold bg-gray-400">
                    ?
                </div>
                <div class="ml-4">
                    <p class="font-semibold text-gray-900">No Students Assigned</p>
                    <p class="text-sm text-gray-600">This project has no students assigned yet</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Project Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Progress -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Progress Overview</h3>
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Overall Progress</span>
                        <span class="text-2xl font-bold" style="color: #7A001E;">{{ $project->progress }}%</span>
                    </div>
                    <div class="w-full h-4 bg-gray-200 rounded-full">
                        <div class="h-4 rounded-full transition-all" style="background-color: #7A001E; width: {{ $project->progress }}%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-600 mb-1">Start Date</p>
                        <p class="font-semibold text-blue-900">{{ $project->start_date->format('M d, Y') }}</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <p class="text-sm text-green-600 mb-1">End Date</p>
                        <p class="font-semibold text-green-900">{{ $project->end_date->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600">Duration</p>
                    <p class="font-semibold text-gray-900">{{ $project->start_date->diffInDays($project->end_date) }} days</p>
                </div>
            </div>

            <!-- Reports -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Weekly Reports ({{ $project->reports->count() }})</h3>
                    <a href="{{ route('reports.create') }}" class="text-sm font-medium hover:underline" style="color: #7A001E;">Add Report</a>
                </div>

                @forelse($project->reports as $report)
                    <div class="border-l-4 rounded-r-lg p-4 mb-3 hover:bg-gray-50 transition-colors
                        @if($report->status === 'Submitted') border-green-500
                        @elseif($report->status === 'Review') border-orange-500
                        @else border-red-500
                        @endif">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="font-semibold text-gray-900">Week {{ $report->week_number }}</h4>
                                    <span class="ml-3 px-2 py-1 text-xs font-medium rounded-full
                                        @if($report->status === 'Submitted') bg-green-100 text-green-800
                                        @elseif($report->status === 'Review') bg-orange-100 text-orange-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $report->status }}
                                    </span>
                                    @if($report->grade)
                                        <span class="ml-2 px-2 py-1 text-xs font-bold rounded" style="background-color: rgba(122, 0, 30, 0.1); color: #7A001E;">
                                            {{ $report->grade }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Submitted: {{ $report->submission_date->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-700 line-clamp-2">{{ $report->content }}</p>
                            </div>
                            <a href="{{ route('reports.show', $report) }}" class="ml-4 px-3 py-1.5 text-sm border rounded-lg hover:bg-gray-50" style="border-color: #7A001E; color: #7A001E;">
                                View
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-8">No reports submitted yet</p>
                @endforelse
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Project Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Project Information</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Project Type</p>
                        <p class="font-semibold text-gray-900">{{ $project->project_type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Semester</p>
                        <p class="font-semibold text-gray-900">{{ $project->semester }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status</p>
                        <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                            @if($project->status === 'Completed') bg-green-100 text-green-800
                            @elseif($project->status === 'In Progress') bg-blue-100 text-blue-800
                            @elseif($project->status === 'Review') bg-orange-100 text-orange-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $project->status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Created</p>
                        <p class="font-medium text-gray-900">{{ $project->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Last Updated</p>
                        <p class="font-medium text-gray-900">{{ $project->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Project File Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Project File</h3>
                
                @if($project->project_file)
                    <div class="mb-4">
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="font-medium text-green-900">Project File Uploaded</p>
                                <p class="text-sm text-green-600">Uploaded: {{ $project->file_uploaded_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ Storage::url($project->project_file) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View File
                            </a>
                        </div>
                    </div>
                @else
                    <div class="mb-4">
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <svg class="w-8 h-8 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">No Project File</p>
                                <p class="text-sm text-gray-600">No project file has been uploaded yet</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- File Upload Form -->
                <form action="{{ route('projects.submit', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <label for="project_file" class="block text-sm font-medium text-gray-700 mb-2">Submit Project File</label>
                        <input type="file" id="project_file" name="project_file" accept=".pdf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" style="file:border-color: #7A001E;">
                        <p class="mt-1 text-xs text-gray-500">Only PDF files are allowed. Maximum size: 10MB</p>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity" style="background-color: #7A001E;">
                        Upload Project File
                    </button>
                </form>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('projects.edit', $project) }}" class="block w-full px-4 py-2 text-center border rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
                        Edit Project
                    </a>
                    <button onclick="window.print()" class="block w-full px-4 py-2 text-center border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Export PDF
                    </button>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full px-4 py-2 text-center bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Delete Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style media="print">
    /* Hide navigation, header actions, and action buttons when printing */
    nav, header, .no-print,
    button:not(.print-show),
    form[method="POST"] {
        display: none !important;
    }
    
    /* Optimize layout for print */
    body {
        background: white !important;
    }
    
    .bg-gray-50 {
        background: #f9fafb !important;
    }
    
    /* Make sure content fits on page */
    .max-w-7xl, .max-w-4xl {
        max-width: 100% !important;
    }
    
    /* Remove shadows and borders that don't look good in PDF */
    .shadow-sm, .shadow-lg {
        box-shadow: none !important;
    }
    
    /* Ensure proper page breaks */
    .space-y-6 > * {
        page-break-inside: avoid;
    }
    
    /* Hide the Actions sidebar in print */
    .space-y-6 > div:last-child {
        display: none !important;
    }
    
    /* Make main content full width */
    .lg\:col-span-2 {
        grid-column: span 3 !important;
    }
</style>

@endsection
