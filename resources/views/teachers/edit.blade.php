@extends('layouts.dashboard')

@section('title', 'Edit Teacher')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6">
            <h3 class="text-xl font-semibold" style="color: #2E2E2E;">Edit Teacher Information</h3>
            <p class="text-sm text-gray-600 mt-1">Update the teacher details below.</p>
        </div>

        <form action="{{ route('teachers.update', $teacher) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('name') border-red-500 @enderror"
                           value="{{ old('name', $teacher->name) }}" placeholder="e.g., Dr. Ahmet Yılmaz">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('email') border-red-500 @enderror"
                           value="{{ old('email', $teacher->email) }}" placeholder="e.g., ahmet.yilmaz@university.edu">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="md:col-span-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 @error('password') border-red-500 @enderror"
                           placeholder="Leave blank to keep current password">
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current password</p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('teachers.show', $teacher) }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 text-white rounded-lg hover:opacity-90 transition-opacity" 
                        style="background-color: #7A001E;">
                    Update Teacher
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
