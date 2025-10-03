@extends('layouts.dashboard')

@section('title', 'Create New Report')
@section('subtitle', 'Submit a weekly progress report')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('reports.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Project Selection -->
            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">Select Project *</label>
                <select id="project_id" name="project_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('project_id') border-red-500 @enderror">
                    <option value="">Choose a project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->title }} - {{ $project->student->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Week Number and Submission Date -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="week_number" class="block text-sm font-medium text-gray-700 mb-2">Week Number *</label>
                    <input type="number" id="week_number" name="week_number" required min="1"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('week_number') border-red-500 @enderror"
                           value="{{ old('week_number') }}"
                           placeholder="1">
                    @error('week_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="submission_date" class="block text-sm font-medium text-gray-700 mb-2">Submission Date *</label>
                    <input type="date" id="submission_date" name="submission_date" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('submission_date') border-red-500 @enderror"
                           value="{{ old('submission_date', date('Y-m-d')) }}">
                    @error('submission_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Report Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Report Content *</label>
                <textarea id="content" name="content" required rows="8"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('content') border-red-500 @enderror"
                          placeholder="Describe the progress made this week, challenges faced, and next steps...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status and Grade -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="Submitted" {{ old('status') == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="Review" {{ old('status') == 'Review' ? 'selected' : '' }}>Review</option>
                        <option value="Overdue" {{ old('status') == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700 mb-2">Grade (Optional)</label>
                    <input type="text" id="grade" name="grade"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('grade') border-red-500 @enderror"
                           value="{{ old('grade') }}"
                           placeholder="e.g., A, B+, B">
                    @error('grade')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('reports.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 text-white rounded-lg hover:opacity-90 transition-opacity" 
                        style="background-color: #7A001E;">
                    Create Report
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
