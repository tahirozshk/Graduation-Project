@extends('layouts.dashboard')

@section('title', 'Create New Project')
@section('subtitle', 'Add a new project for a student')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Student Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Students *</label>
                <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3">
                    @foreach($students as $student)
                        <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded">
                            <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" 
                                   {{ in_array($student->id, old('student_ids', [])) ? 'checked' : '' }}
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
                       value="{{ old('title') }}"
                       placeholder="e.g., AI-Based Student Performance Analysis">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" required rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Describe the project objectives, scope, and expected outcomes...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Type and Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="project_type" class="block text-sm font-medium text-gray-700 mb-2">Project Type *</label>
                    <select id="project_type" name="project_type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('project_type') border-red-500 @enderror">
                        <option value="Research" {{ old('project_type') == 'Research' ? 'selected' : '' }}>Research</option>
                        <option value="Development" {{ old('project_type') == 'Development' ? 'selected' : '' }}>Development</option>
                    </select>
                    @error('project_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="Planning" {{ old('status') == 'Planning' ? 'selected' : '' }}>Planning</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Review" {{ old('status') == 'Review' ? 'selected' : '' }}>Review</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('start_date') border-red-500 @enderror"
                           value="{{ old('start_date') }}">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                    <input type="date" id="end_date" name="end_date" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('end_date') border-red-500 @enderror"
                           value="{{ old('end_date') }}">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Progress -->
            <div>
                <label for="progress" class="block text-sm font-medium text-gray-700 mb-2">Initial Progress (%)</label>
                <input type="number" id="progress" name="progress" min="0" max="100"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('progress') border-red-500 @enderror"
                       value="{{ old('progress', 0) }}">
                @error('progress')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('projects.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 text-white rounded-lg hover:opacity-90 transition-opacity" 
                        style="background-color: #7A001E;">
                    Create Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
