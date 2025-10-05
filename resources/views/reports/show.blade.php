@extends('layouts.dashboard')

@section('title', 'Report Details')
@section('subtitle', 'Week ' . $report->week_number . ' - ' . $report->project->title)

@section('header-actions')
    <a href="{{ route('reports.edit', $report) }}" class="px-5 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity flex items-center shadow-sm" style="background-color: #7A001E;">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Report
    </a>
    <a href="{{ route('reports.index') }}" class="px-5 py-2.5 border text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors" style="border-color: #7A001E; color: #7A001E;">
        Back to Reports
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Report Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Week {{ $report->week_number }} Report</h2>
                <p class="text-gray-600">{{ $report->project->title }}</p>
            </div>
            <span class="px-4 py-2 text-sm font-medium rounded-full
                @if($report->status === 'Submitted') bg-green-100 text-green-800
                @elseif($report->status === 'Review') bg-orange-100 text-orange-800
                @else bg-red-100 text-red-800
                @endif">
                {{ $report->status }}
            </span>
        </div>

        <!-- Report Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Student Card -->
            <div class="relative overflow-hidden rounded-xl p-6 shadow-sm" style="background: linear-gradient(135deg, #7A001E 0%, #9d0026 100%);">
                <div class="relative z-10">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg mr-3">
                            {{ substr($report->project->students->first()->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs text-white text-opacity-80 mb-1">Student</p>
                            <p class="font-bold text-white text-lg">{{ $report->project->students->first()->name ?? 'Unknown Student' }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white border-opacity-20">
                        <p class="text-sm text-white text-opacity-90 font-mono">{{ $report->project->students->first()->student_id ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            </div>

            <!-- Submission Date Card -->
            <div class="relative overflow-hidden rounded-xl p-6 shadow-sm bg-gradient-to-br from-blue-500 to-blue-600">
                <div class="relative z-10">
                    <div class="flex items-start mb-3">
                        <div class="w-12 h-12 rounded-xl bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-white text-opacity-80 mb-1">Submission Date</p>
                            <p class="font-bold text-white text-lg">{{ $report->submission_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white border-opacity-20">
                        <div class="flex items-center text-white text-opacity-90">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm">{{ $report->submission_date->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-white opacity-5 rounded-full -mr-8 -mb-8"></div>
            </div>

            <!-- Grade Card -->
            <div class="relative overflow-hidden rounded-xl p-6 shadow-sm bg-gradient-to-br from-green-500 to-green-600">
                <div class="relative z-10">
                    <div class="flex items-start mb-3">
                        <div class="w-12 h-12 rounded-xl bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-white text-opacity-80 mb-1">Grade</p>
                            @if($report->grade)
                                <p class="font-black text-white text-4xl">{{ $report->grade }}</p>
                            @else
                                <p class="text-white text-opacity-80 italic text-sm">Not graded yet</p>
                            @endif
                        </div>
                    </div>
                    @if($report->grade)
                        <div class="mt-4 pt-4 border-t border-white border-opacity-20">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="h-2 bg-white bg-opacity-20 rounded-full overflow-hidden">
                                        <div class="h-full bg-white rounded-full" style="width: {{ $report->grade === 'A' ? '100' : ($report->grade === 'A-' ? '95' : ($report->grade === 'B+' ? '85' : '75')) }}%"></div>
                                    </div>
                                </div>
                                <span class="ml-3 text-xs text-white text-opacity-90 font-semibold">Excellent</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-12 -mt-12"></div>
            </div>
        </div>
    </div>

    <!-- Project Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Project Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Project Title</p>
                <p class="font-medium text-gray-900">{{ $report->project->title }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Project Type</p>
                <p class="font-medium text-gray-900">{{ $report->project->project_type }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Project Status</p>
                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                    @if($report->project->status === 'Completed') bg-green-100 text-green-800
                    @elseif($report->project->status === 'In Progress') bg-blue-100 text-blue-800
                    @elseif($report->project->status === 'Review') bg-orange-100 text-orange-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ $report->project->status }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-600">Progress</p>
                <div class="flex items-center mt-1">
                    <div class="flex-1 h-2 bg-gray-200 rounded-full mr-3">
                        <div class="h-2 rounded-full" style="background-color: #7A001E; width: {{ $report->project->progress }}%"></div>
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ $report->project->progress }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Content -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Report Content</h3>
        <div class="prose max-w-none">
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $report->content }}</div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-between items-center">
        <form action="{{ route('reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                Delete Report
            </button>
        </form>

        <div class="flex space-x-3">
            <button class="px-6 py-2.5 border border-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                Download PDF
            </button>
            <a href="{{ route('reports.edit', $report) }}" class="px-6 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity" style="background-color: #7A001E;">
                Edit Report
            </a>
        </div>
    </div>
</div>
@endsection
