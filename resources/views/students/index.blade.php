@extends('layouts.dashboard')

@section('title', 'Students')
@section('subtitle', Auth::user()->isAdmin() ? 'Manage all students in the system' : 'Manage your supervised students')

@section('header-actions')
    <a href="{{ route('students.create') }}" class="px-5 py-2.5 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity flex items-center shadow-sm" style="background-color: #7A001E;">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add Student
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Search and Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" id="searchInput" placeholder="Search students by name, ID, or email..." 
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent text-sm" 
                       style="focus:ring-color: #7A001E;">
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <select id="projectTypeFilter" class="px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2">
                <option value="">All Project Types</option>
                <option value="Internship I">Internship I</option>
                <option value="Internship II">Internship II</option>
                <option value="Graduation I">Graduation I</option>
                <option value="Graduation II">Graduation II</option>
            </select>
            <select id="semesterFilter" class="px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2">
                <option value="">All Semesters</option>
                <option value="Fall">Fall</option>
                <option value="Spring">Spring</option>
                <option value="Summer School">Summer School</option>
            </select>
        </div>
    </div>

    <!-- Students Header -->
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900">Students List ({{ $students->count() }})</h3>
        <button onclick="exportToExcel()" class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Export Excel
        </button>
    </div>

    <!-- Students Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                        @if(Auth::user()->isAdmin())
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Teacher</th>
                        @endif
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Project Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Semester</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Assigned Projects</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="studentsTable">
                    @forelse($students as $student)
                        <tr class="student-row hover:bg-gray-50 transition-colors" 
                            data-status="{{ $student->status }}" 
                            data-department="{{ $student->department }}"
                            data-name="{{ strtolower($student->name) }}"
                            data-email="{{ strtolower($student->email) }}"
                            data-student-id="{{ strtolower($student->student_id) }}"
                            data-project-type="{{ $student->projects->count() > 0 ? $student->projects->first()->project_type : '' }}"
                            data-semester="{{ $student->projects->count() > 0 ? $student->projects->first()->semester : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-semibold text-sm" style="background-color: #7A001E;">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $student->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $student->student_id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $student->email }}
                                </div>
                            </td>
                            @if(Auth::user()->isAdmin())
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($student->teachers->count() > 0)
                                        @foreach($student->teachers as $teacher)
                                            <div class="text-sm text-gray-900">{{ $teacher->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $teacher->email }}</div>
                                            @if(!$loop->last)<br>@endif
                                        @endforeach
                                    @else
                                        <div class="text-sm text-gray-400">No supervisor</div>
                                    @endif
                                </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->projects->count() > 0)
                                    <div class="text-sm font-medium text-gray-900">{{ $student->projects->first()->project_type }}</div>
                                @else
                                    <div class="text-sm text-gray-400">-</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->projects->count() > 0)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $student->projects->first()->semester }}
                                    </span>
                                @else
                                    <div class="text-sm text-gray-400">-</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->projects->count() > 0)
                                    <div class="text-sm font-medium text-gray-900">{{ $student->projects->first()->title }}</div>
                                @else
                                    <div class="text-sm text-gray-400">No projects assigned</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('students.show', $student) }}" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">View</a>
                                    <a href="{{ route('students.edit', $student) }}" class="px-4 py-2 rounded-lg text-white hover:opacity-90 transition-opacity" style="background-color: #7A001E;">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? '9' : '8' }}" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No students</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by adding a new student.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const projectTypeFilter = document.getElementById('projectTypeFilter');
    const semesterFilter = document.getElementById('semesterFilter');
    const studentRows = document.querySelectorAll('.student-row');

    function filterStudents() {
        const searchTerm = searchInput.value.toLowerCase();
        const projectTypeValue = projectTypeFilter.value;
        const semesterValue = semesterFilter.value;

        studentRows.forEach(row => {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const studentId = row.dataset.studentId;
            const projectType = row.dataset.projectType;
            const semester = row.dataset.semester;

            const matchesSearch = name.includes(searchTerm) || 
                                email.includes(searchTerm) || 
                                studentId.includes(searchTerm);
            
            const matchesProjectType = !projectTypeValue || projectType === projectTypeValue;
            const matchesSemester = !semesterValue || semester === semesterValue;

            row.style.display = (matchesSearch && matchesProjectType && matchesSemester) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterStudents);
    projectTypeFilter.addEventListener('change', filterStudents);
    semesterFilter.addEventListener('change', filterStudents);
});

// Export to Excel function
function exportToExcel() {
    const table = document.getElementById('studentsTable');
    const rows = Array.from(table.querySelectorAll('.student-row')).filter(row => row.style.display !== 'none');
    
    // Prepare data
    let csvContent = "Student Name,Student ID,Email,Teacher,Project Type,Semester,Assigned Project,Status\n";
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        
        // Get data from data attributes (more reliable)
        const studentName = row.dataset.name || '';
        const studentEmail = row.dataset.email || '';
        const studentId = row.dataset.studentId || '';
        const projectType = row.dataset.projectType || '-';
        const semester = row.dataset.semester || '-';
        
        // Get other data from DOM
        const email = cells[2]?.querySelector('.text-sm')?.textContent.trim() || studentEmail;
        const studentIdFromCell = cells[1]?.textContent.trim() || studentId;
        
        // Teacher info (only if admin)
        const teacherCell = cells[3];
        let teacherInfo = '';
        @if(Auth::user()->isAdmin())
            teacherInfo = teacherCell?.querySelector('.text-sm.text-gray-900')?.textContent.trim() || 'No supervisor';
            const projectCell = cells[6];
            const statusCell = cells[7];
        @else
            const projectCell = cells[5];
            const statusCell = cells[6];
        @endif
        
        const project = projectCell?.querySelector('.text-sm.font-medium')?.textContent.trim() || 'No projects assigned';
        const status = statusCell?.querySelector('span')?.textContent.trim() || '';
        
        csvContent += `"${studentName}","${studentIdFromCell}","${email}","${teacherInfo}","${projectType}","${semester}","${project}","${status}"\n`;
    });
    
    // Add BOM for proper UTF-8 encoding in Excel
    const BOM = '\uFEFF';
    const csvWithBOM = BOM + csvContent;
    
    // Create download link
    const blob = new Blob([csvWithBOM], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    
    link.setAttribute('href', url);
    link.setAttribute('download', 'students_list_' + new Date().toISOString().split('T')[0] + '.csv');
    link.style.visibility = 'hidden';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

@endsection
