<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Student;
use App\Models\ProjectGroup;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        
        $projects = [
            [
                'title' => 'E-Ticaret Platformu Geliştirme',
                'description' => 'Modern web teknolojileri kullanarak kapsamlı bir e-ticaret platformu geliştirme projesi.',
                'project_type' => 'Graduation I',
                'semester' => 'Fall',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-31',
                'progress' => 45,
                'status' => 'In Progress',
            ],
            [
                'title' => 'Yapay Zeka Destekli Öneri Sistemi',
                'description' => 'Machine learning algoritmaları kullanarak kullanıcı davranışlarını analiz eden öneri sistemi.',
                'project_type' => 'Graduation II',
                'semester' => 'Spring',
                'start_date' => '2024-08-15',
                'end_date' => '2025-01-15',
                'progress' => 30,
                'status' => 'In Progress',
            ],
            [
                'title' => 'Mobil Uygulama Geliştirme',
                'description' => 'React Native kullanarak cross-platform mobil uygulama geliştirme.',
                'project_type' => 'Internship I',
                'semester' => 'Fall',
                'start_date' => '2024-10-01',
                'end_date' => '2025-03-01',
                'progress' => 15,
                'status' => 'Planning',
            ],
            [
                'title' => 'Blockchain Tabanlı Güvenlik Sistemi',
                'description' => 'Blockchain teknolojisi kullanarak veri güvenliği sağlayan sistem geliştirme.',
                'project_type' => 'Internship II',
                'semester' => 'Spring',
                'start_date' => '2024-07-01',
                'end_date' => '2024-12-01',
                'progress' => 70,
                'status' => 'Review',
            ],
            [
                'title' => 'IoT Sensör Ağı Yönetimi',
                'description' => 'Internet of Things cihazları için merkezi yönetim sistemi.',
                'project_type' => 'Graduation I',
                'semester' => 'Fall',
                'start_date' => '2024-06-01',
                'end_date' => '2024-11-30',
                'progress' => 90,
                'status' => 'Review',
            ],
        ];

        foreach ($projects as $index => $projectData) {
            $project = Project::create($projectData);
            
            // Assign students to projects (1-3 students per project)
            $projectStudents = $students->random(rand(1, 3));
            
            foreach ($projectStudents as $studentIndex => $student) {
                ProjectGroup::create([
                    'project_id' => $project->id,
                    'student_id' => $student->id,
                    'role' => $studentIndex === 0 ? 'Leader' : 'Member',
                ]);
            }
        }
    }
}
