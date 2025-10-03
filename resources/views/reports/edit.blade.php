@extends('layouts.dashboard')

@section('title', 'Edit Report')
@section('subtitle', 'Week ' . $report->week_number . ' - ' . $report->project->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('reports.update', $report) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Project Selection -->
            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">Select Project *</label>
                <select id="project_id" name="project_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('project_id') border-red-500 @enderror">
                    <option value="">Choose a project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $report->project_id) == $project->id ? 'selected' : '' }}>
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
                           value="{{ old('week_number', $report->week_number) }}">
                    @error('week_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="submission_date" class="block text-sm font-medium text-gray-700 mb-2">Submission Date *</label>
                    <input type="date" id="submission_date" name="submission_date" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('submission_date') border-red-500 @enderror"
                           value="{{ old('submission_date', $report->submission_date->format('Y-m-d')) }}">
                    @error('submission_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Report Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Report Content *</label>
                <textarea id="content" name="content" required rows="8"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('content') border-red-500 @enderror">{{ old('content', $report->content) }}</textarea>
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
                        <option value="Submitted" {{ old('status', $report->status) == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="Review" {{ old('status', $report->status) == 'Review' ? 'selected' : '' }}>Review</option>
                        <option value="Overdue" {{ old('status', $report->status) == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700 mb-2">Grade (Optional)</label>
                    <input type="text" id="grade" name="grade"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent @error('grade') border-red-500 @enderror"
                           value="{{ old('grade', $report->grade) }}"
                           placeholder="e.g., A, B+, B">
                    @error('grade')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-6 border-t">
                <form action="{{ route('reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Delete Report
                    </button>
                </form>

                <div class="flex space-x-3">
                    <a href="{{ route('reports.show', $report) }}" 
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 text-white rounded-lg hover:opacity-90 transition-opacity" 
                            style="background-color: #7A001E;">
                        Update Report
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
