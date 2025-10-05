<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SupervisorGroup;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::all();
        
        $students = [
            [
                'student_id' => '2021001',
                'name' => 'Ali Veli',
                'email' => 'ali.veli@student.edu',
                'year' => '2021',
                'department' => 'Computer Engineering',
                'status' => 'active',
            ],
            [
                'student_id' => '2021002',
                'name' => 'Ayşe Kaya',
                'email' => 'ayse.kaya@student.edu',
                'year' => '2021',
                'department' => 'Computer Engineering',
                'status' => 'active',
            ],
            [
                'student_id' => '2021003',
                'name' => 'Mehmet Öz',
                'email' => 'mehmet.oz@student.edu',
                'year' => '2021',
                'department' => 'Software Engineering',
                'status' => 'active',
            ],
            [
                'student_id' => '2021004',
                'name' => 'Fatma Demir',
                'email' => 'fatma.demir@student.edu',
                'year' => '2021',
                'department' => 'Software Engineering',
                'status' => 'active',
            ],
            [
                'student_id' => '2021005',
                'name' => 'Can Yılmaz',
                'email' => 'can.yilmaz@student.edu',
                'year' => '2021',
                'department' => 'Computer Engineering',
                'status' => 'active',
            ],
            [
                'student_id' => '2021006',
                'name' => 'Zeynep Çelik',
                'email' => 'zeynep.celik@student.edu',
                'year' => '2021',
                'department' => 'Information Systems',
                'status' => 'active',
            ],
            [
                'student_id' => '2021007',
                'name' => 'Emre Şahin',
                'email' => 'emre.sahin@student.edu',
                'year' => '2021',
                'department' => 'Information Systems',
                'status' => 'active',
            ],
            [
                'student_id' => '2021008',
                'name' => 'Selin Arslan',
                'email' => 'selin.arslan@student.edu',
                'year' => '2021',
                'department' => 'Computer Engineering',
                'status' => 'active',
            ],
        ];

        foreach ($students as $index => $studentData) {
            $student = Student::create($studentData);
            
            // Assign student to a teacher (round-robin assignment)
            $teacher = $teachers[$index % $teachers->count()];
            
            SupervisorGroup::create([
                'teacher_id' => $teacher->id,
                'student_id' => $student->id,
            ]);
        }
    }
}
