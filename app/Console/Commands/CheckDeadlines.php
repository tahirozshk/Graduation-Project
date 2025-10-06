<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\Report;
use App\Models\Notification;
use App\Models\Teacher;
use Carbon\Carbon;

class CheckDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deadlines:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for approaching project and report deadlines and create notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for approaching deadlines...');
        
        $createdNotifications = 0;
        
        // Check project deadlines (1 week before)
        $projectDeadline = Carbon::now()->addWeek();
        $approachingProjects = Project::where('end_date', '<=', $projectDeadline)
            ->where('end_date', '>', Carbon::now())
            ->where('status', '!=', 'Completed')
            ->get();
            
        foreach ($approachingProjects as $project) {
            $daysLeft = Carbon::now()->diffInDays($project->end_date);
            $message = "Project '{$project->title}' deadline is approaching ({$daysLeft} days left)";
            
            // Get teachers for this project
            $teachers = $project->students()->with('teachers')->get()
                ->pluck('teachers')
                ->flatten()
                ->unique('id');
                
            foreach ($teachers as $teacher) {
                // Check if notification already exists
                $existingNotification = Notification::where('teacher_id', $teacher->id)
                    ->where('message', $message)
                    ->where('type', 'project_deadline')
                    ->first();
                    
                if (!$existingNotification) {
                    Notification::create([
                        'teacher_id' => $teacher->id,
                        'message' => $message,
                        'type' => 'project_deadline',
                        'is_read' => false,
                    ]);
                    $createdNotifications++;
                }
            }
        }
        
        // Check report deadlines (2 days before)
        $reportDeadline = Carbon::now()->addDays(2);
        $approachingReports = Report::where('submission_date', '<=', $reportDeadline)
            ->where('submission_date', '>', Carbon::now())
            ->where('status', '!=', 'Submitted')
            ->get();
            
        foreach ($approachingReports as $report) {
            $daysLeft = Carbon::now()->diffInDays($report->submission_date);
            $message = "Report for Week {$report->week_number} deadline is approaching ({$daysLeft} days left)";
            
            // Get teachers for this report's project
            $teachers = $report->project->students()->with('teachers')->get()
                ->pluck('teachers')
                ->flatten()
                ->unique('id');
                
            foreach ($teachers as $teacher) {
                // Check if notification already exists
                $existingNotification = Notification::where('teacher_id', $teacher->id)
                    ->where('message', $message)
                    ->where('type', 'report_deadline')
                    ->first();
                    
                if (!$existingNotification) {
                    Notification::create([
                        'teacher_id' => $teacher->id,
                        'message' => $message,
                        'type' => 'report_deadline',
                        'is_read' => false,
                    ]);
                    $createdNotifications++;
                }
            }
        }
        
        $this->info("Created {$createdNotifications} deadline notifications.");
        
        // Clean old notifications (older than 30 days)
        $oldNotifications = Notification::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        if ($oldNotifications > 0) {
            $this->info("Cleaned {$oldNotifications} old notifications.");
        }
        
        return 0;
    }
}