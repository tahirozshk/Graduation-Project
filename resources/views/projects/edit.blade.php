@extends('layouts.dashboard')

@section('title', 'Edit Project')
@section('subtitle', $project->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Student Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Students *</label>
                <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3">
                    @foreach($students as $student)
                        <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded">
                            <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" 
                                   {{ in_array($student->id, old('student_ids', $project->students->pluck('id')->toArray())) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm">{{ $student->name }} ({{ $student->student_id }}) - {{ $student->department }}</span>
                        </label>
                    @endforeach
                </div>
                @error('student_ids')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('student_ids.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Project Title *</label>
                <input type="text" id="title" name="title" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('title') border-red-500 @enderror"
                       value="{{ old('title', $project->title) }}">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" required rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Type and Semester -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="project_type" class="block text-sm font-medium text-gray-700 mb-2">Project Type *</label>
                    <select id="project_type" name="project_type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('project_type') border-red-500 @enderror">
                        <option value="Internship I" {{ old('project_type', $project->project_type) == 'Internship I' ? 'selected' : '' }}>Internship I</option>
                        <option value="Internship II" {{ old('project_type', $project->project_type) == 'Internship II' ? 'selected' : '' }}>Internship II</option>
                        <option value="Graduation I" {{ old('project_type', $project->project_type) == 'Graduation I' ? 'selected' : '' }}>Graduation I</option>
                        <option value="Graduation II" {{ old('project_type', $project->project_type) == 'Graduation II' ? 'selected' : '' }}>Graduation II</option>
                    </select>
                    @error('project_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Semester *</label>
                    <select id="semester" name="semester" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('semester') border-red-500 @enderror">
                        <option value="Fall" {{ old('semester', $project->semester) == 'Fall' ? 'selected' : '' }}>Fall</option>
                        <option value="Spring" {{ old('semester', $project->semester) == 'Spring' ? 'selected' : '' }}>Spring</option>
                        <option value="Summer School" {{ old('semester', $project->semester) == 'Summer School' ? 'selected' : '' }}>Summer School</option>
                    </select>
                    @error('semester')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                <select id="status" name="status" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="Planning" {{ old('status', $project->status) == 'Planning' ? 'selected' : '' }}>Planning</option>
                    <option value="In Progress" {{ old('status', $project->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Review" {{ old('status', $project->status) == 'Review' ? 'selected' : '' }}>Review</option>
                    <option value="Completed" {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('start_date') border-red-500 @enderror"
                           value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                    <input type="date" id="end_date" name="end_date" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('end_date') border-red-500 @enderror"
                           value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Progress -->
            <div>
                <label for="progress" class="block text-sm font-medium text-gray-700 mb-2">Progress (%)</label>
                <div class="flex items-center space-x-4">
                    <input type="range" id="progress_range" min="0" max="100"
                           value="{{ old('progress', $project->progress) }}"
                           class="flex-1"
                           oninput="document.getElementById('progress').value = this.value; document.getElementById('progress_display').textContent = this.value + '%';">
                    <input type="number" id="progress" name="progress" min="0" max="100"
                           class="w-24 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('progress') border-red-500 @enderror"
                           value="{{ old('progress', $project->progress) }}"
                           oninput="document.getElementById('progress_range').value = this.value; document.getElementById('progress_display').textContent = this.value + '%';">
                    <span id="progress_display" class="text-lg font-bold" style="color: #7A001E;">{{ $project->progress }}%</span>
                </div>
                @error('progress')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('projects.show', $project) }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 text-white rounded-lg hover:opacity-90 transition-opacity" 
                        style="background-color: #7A001E;">
                    Update Project
                </button>
            </div>
        </form>

        <!-- Delete Form (Separate from Update Form) -->
        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="mt-6" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Delete Project
            </button>
        </form>
    </div>
</div>
@endsection
