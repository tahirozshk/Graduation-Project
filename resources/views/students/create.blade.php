@extends('layouts.dashboard')

@section('title', 'Add New Student')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6">
            <h3 class="text-xl font-semibold" style="color: #2E2E2E;">Student Information</h3>
            <p class="text-sm text-gray-600 mt-1">Fill in the details to add a new student.</p>
        </div>

        <form action="{{ route('students.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Student ID -->
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">Student ID *</label>
                    <input type="text" id="student_id" name="student_id" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('student_id') border-red-500 @enderror"
                           value="{{ old('student_id') }}" placeholder="e.g., 20210001">
                    @error('student_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('name') border-red-500 @enderror"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('email') border-red-500 @enderror"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Year -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Academic Year *</label>
                    <select id="year" name="year" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('year') border-red-500 @enderror">
                        <option value="">Select Year</option>
                        <option value="2021" {{ old('year') == '2021' ? 'selected' : '' }}>2021</option>
                        <option value="2022" {{ old('year') == '2022' ? 'selected' : '' }}>2022</option>
                        <option value="2023" {{ old('year') == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ old('year') == '2024' ? 'selected' : '' }}>2024</option>
                    </select>
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department *</label>
                    <select id="department" name="department" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('department') border-red-500 @enderror">
                        <option value="">Select Department</option>
                        <option value="Computer Engineering" {{ old('department') == 'Computer Engineering' ? 'selected' : '' }}>Computer Engineering</option>
                        <option value="Software Engineering" {{ old('department') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                        <option value="Information Systems" {{ old('department') == 'Information Systems' ? 'selected' : '' }}>Information Systems</option>
                        <option value="Data Science" {{ old('department') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                    </select>
                    @error('department')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('students.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 text-white rounded-lg hover:opacity-90 transition-opacity" 
                        style="background-color: #7A001E;">
                    Add Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

