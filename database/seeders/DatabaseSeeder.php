<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Project;
use App\Models\Report;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 3 Teachers
        $teachers = [];
        $teachers[] = User::create([
            'name' => 'Dr. Ahmed Hassan',
            'email' => 'ahmed.hassan@ydu.edu.tr',
            'password' => Hash::make('password'),
        ]);

        $teachers[] = User::create([
            'name' => 'Dr. Fatima Yilmaz',
            'email' => 'fatima.yilmaz@ydu.edu.tr',
            'password' => Hash::make('password'),
        ]);

        $teachers[] = User::create([
            'name' => 'Dr. Mehmet Demir',
            'email' => 'mehmet.demir@ydu.edu.tr',
            'password' => Hash::make('password'),
        ]);

        // Create 10 Students
        $students = [];
        $departments = ['Computer Engineering', 'Software Engineering', 'Information Systems', 'Data Science'];
        $years = ['2021', '2022', '2023', '2024'];

        for ($i = 1; $i <= 10; $i++) {
            $students[] = Student::create([
                'student_id' => '202100' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'teacher_id' => $teachers[array_rand($teachers)]->id,
                'name' => 'Student ' . $i,
                'email' => 'student' . $i . '@ydu.edu.tr',
                'year' => $years[array_rand($years)],
                'department' => $departments[array_rand($departments)],
                'status' => $i <= 8 ? 'active' : 'inactive',
            ]);
        }

        // Create 5 Projects
        $projectTypes = ['Research', 'Development'];
        $projectStatuses = ['Planning', 'In Progress', 'Review', 'Completed'];

        for ($i = 1; $i <= 5; $i++) {
            $startDate = now()->subDays(rand(30, 90));
            $endDate = (clone $startDate)->addDays(rand(90, 180));

            $projects[] = Project::create([
                'student_id' => $students[array_rand($students)]->id,
                'title' => 'Project ' . $i . ': ' . ['AI-Based System', 'Web Application', 'Mobile App', 'Data Analysis Tool', 'IoT Solution'][array_rand(['AI-Based System', 'Web Application', 'Mobile App', 'Data Analysis Tool', 'IoT Solution'])],
                'description' => 'This is a comprehensive project focusing on innovative solutions in technology and research. The project aims to solve real-world problems using cutting-edge technologies.',
                'project_type' => $projectTypes[array_rand($projectTypes)],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'progress' => rand(0, 100),
                'status' => $projectStatuses[array_rand($projectStatuses)],
            ]);
        }

        // Create 10 Reports
        $reportStatuses = ['Submitted', 'Review', 'Overdue'];
        $grades = ['A', 'A-', 'B+', 'B', 'B-', 'C+', null];

        for ($i = 1; $i <= 10; $i++) {
            Report::create([
                'project_id' => $projects[array_rand($projects)]->id,
                'week_number' => rand(1, 12),
                'content' => 'This week, I have made significant progress on the project. Key accomplishments include: 1) Completed initial research phase, 2) Implemented core functionality, 3) Conducted testing and debugging. Next week\'s goals include further optimization and documentation.',
                'submission_date' => now()->subDays(rand(0, 30)),
                'status' => $reportStatuses[array_rand($reportStatuses)],
                'grade' => $grades[array_rand($grades)],
            ]);
        }

        // Create 5 Notifications for each teacher
        $notificationTypes = ['deadline', 'overdue', 'system', 'reminder'];
        $messages = [
            'Project report deadline is approaching',
            'New project submitted for review',
            'Student has completed project milestone',
            'Overdue report requires attention',
            'System maintenance scheduled for tomorrow',
        ];

        foreach ($teachers as $teacher) {
            for ($i = 0; $i < 2; $i++) {
                Notification::create([
                    'teacher_id' => $teacher->id,
                    'message' => $messages[array_rand($messages)],
                    'type' => $notificationTypes[array_rand($notificationTypes)],
                    'is_read' => (bool)rand(0, 1),
                ]);
            }
        }
    }
}
