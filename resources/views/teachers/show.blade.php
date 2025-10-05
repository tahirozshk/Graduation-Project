@extends('layouts.dashboard')

@section('title', 'Teacher Details')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $teacher->name }}</h1>
        <p class="text-gray-600">{{ $teacher->email }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Teacher Info -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Teacher Information</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Name:</span>
                        <p class="text-gray-900">{{ $teacher->name }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Email:</span>
                        <p class="text-gray-900">{{ $teacher->email }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Students:</span>
                        <p class="text-gray-900">{{ $teacher->students->count() }}</p>
                    </div>
                </div>
                <div class="mt-6 flex space-x-3">
                    <a href="{{ route('teachers.edit', $teacher) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit Teacher
                    </a>
                </div>
            </div>
        </div>

        <!-- Students List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Supervised Students</h3>
                @if($teacher->students->count() > 0)
                    <div class="space-y-3">
                        @foreach($teacher->students as $student)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $student->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $student->student_id }} - {{ $student->department }}</p>
                                        <p class="text-sm text-gray-500">{{ $student->year }} • {{ ucfirst($student->status) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $student->projects->count() }} projects
                                        </span>
                                    </div>
                                </div>
                                @if($student->projects->count() > 0)
                                    <div class="mt-3">
                                        <p class="text-xs font-medium text-gray-500 mb-1">Projects:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($student->projects as $project)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                                                    {{ $project->title }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No students assigned to this teacher.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
