<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\Teacher;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first teacher to create notifications for
        $teacher = Teacher::first();
        
        if (!$teacher) {
            $this->command->warn('No teacher found. Please run TeacherSeeder first.');
            return;
        }

        $notifications = [
            [
                'message' => 'Project "E-Commerce Website" deadline is approaching (3 days left)',
                'type' => 'project_deadline',
                'teacher_id' => $teacher->id,
                'is_read' => false,
            ],
            [
                'message' => 'Report for Week 5 deadline is approaching (1 day left)',
                'type' => 'report_deadline',
                'teacher_id' => $teacher->id,
                'is_read' => false,
            ],
            [
                'message' => 'Project "Mobile App Development" deadline is approaching (5 days left)',
                'type' => 'project_deadline',
                'teacher_id' => $teacher->id,
                'is_read' => false,
            ],
            [
                'message' => 'Report for Week 3 deadline is approaching (2 days left)',
                'type' => 'report_deadline',
                'teacher_id' => $teacher->id,
                'is_read' => false,
            ],
            [
                'message' => 'Project "Data Analysis Tool" deadline is approaching (1 day left)',
                'type' => 'project_deadline',
                'teacher_id' => $teacher->id,
                'is_read' => false,
            ]
        ];

        foreach ($notifications as $notificationData) {
            Notification::create($notificationData);
        }

        $this->command->info('Created ' . count($notifications) . ' test notifications.');
    }
}
