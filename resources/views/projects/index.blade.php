@extends('layouts.dashboard')

@section('title', 'Projects')
@section('subtitle', 'Manage student projects and track progress')

@section('header-actions')
    <a href="{{ route('projects.create') }}" class="px-5 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity flex items-center shadow-sm" style="background-color: #7A001E;">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add Project
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" id="searchInput" placeholder="Search projects by title or student name..." 
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent text-sm">
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <select id="statusFilter" class="px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2">
                <option value="">All Status</option>
                <option value="Planning">Planning</option>
                <option value="In Progress">In Progress</option>
                <option value="Review">Review</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
    </div>

    <!-- Projects Grid -->
    <div id="projectsGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
            <div class="project-card bg-white rounded-xl shadow-sm hover:shadow-lg transition-all border border-gray-100 overflow-hidden" 
                 data-status="{{ $project->status }}" 
                 data-type="{{ $project->project_type }}"
                 data-title="{{ strtolower($project->title) }}"
                 data-student="{{ strtolower($project->students->pluck('name')->implode(' ')) }}">
                
                <!-- Project Header with Icon -->
                <div class="p-6 pb-4">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: rgba(122, 0, 30, 0.1);">
                            <svg class="w-6 h-6" style="color: #7A001E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full
                            @if($project->status === 'Completed') bg-green-100 text-green-800
                            @elseif($project->status === 'In Progress') bg-blue-100 text-blue-800
                            @elseif($project->status === 'Review') bg-orange-100 text-orange-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $project->status }}
                        </span>
                    </div>
                    
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">{{ $project->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $project->description }}</p>
                </div>

                <!-- Students Info -->
                <div class="px-6 pb-4">
                    <div class="space-y-3">
                        @foreach($project->students as $student)
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-semibold mr-3" style="background-color: #7A001E;">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ $student->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $student->student_id }}</p>
                                </div>
                                @if($student->pivot->role === 'Leader')
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Leader</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Project Details -->
                <div class="px-6 pb-4 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Start Date</p>
                        <p class="font-medium text-gray-900">{{ $project->start_date->format('Y-m-d') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">End Date</p>
                        <p class="font-medium text-gray-900">{{ $project->end_date->format('Y-m-d') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Type</p>
                        <p class="font-medium text-gray-900">{{ $project->project_type }}</p>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="px-6 pb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-gray-600">Progress</span>
                        <span class="text-xs font-bold text-gray-900">{{ $project->progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full transition-all @if($project->progress < 30) bg-red-500 @elseif($project->progress < 70) bg-yellow-500 @else bg-green-500 @endif" style="width: {{ $project->progress }}%"></div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 pb-6">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="w-full block text-center px-4 py-2.5 border rounded-lg font-medium text-sm transition-colors hover:bg-gray-50" 
                       style="border-color: #7A001E; color: #7A001E;">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const projectCards = document.querySelectorAll('.project-card');

    function filterProjects() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;

        projectCards.forEach(card => {
            const title = card.dataset.title;
            const student = card.dataset.student;
            const status = card.dataset.status;

            const matchesSearch = title.includes(searchTerm) || student.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;

            card.style.display = (matchesSearch && matchesStatus) ? 'block' : 'none';
        });
    }

    searchInput.addEventListener('input', filterProjects);
    statusFilter.addEventListener('change', filterProjects);
});
</script>
@endsection
