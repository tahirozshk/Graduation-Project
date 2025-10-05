<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Dr. Ahmet Yılmaz',
                'email' => 'ahmet.yilmaz@university.edu',
                'password' => 'password123',
            ],
            [
                'name' => 'Prof. Dr. Ayşe Demir',
                'email' => 'ayse.demir@university.edu',
                'password' => 'password123',
            ],
            [
                'name' => 'Dr. Mehmet Kaya',
                'email' => 'mehmet.kaya@university.edu',
                'password' => 'password123',
            ],
            [
                'name' => 'Prof. Dr. Fatma Özkan',
                'email' => 'fatma.ozkan@university.edu',
                'password' => 'password123',
            ],
            [
                'name' => 'Dr. Ali Çelik',
                'email' => 'ali.celik@university.edu',
                'password' => 'password123',
            ],
        ];

        foreach ($teachers as $teacherData) {
            // Create teacher record
            $teacher = Teacher::create([
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'password' => $teacherData['password'],
            ]);

            // Create user record for authentication
            User::create([
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'password' => $teacherData['password'],
                'role' => 'teacher',
                'status' => 'active',
            ]);
        }
    }
}
