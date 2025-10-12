<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if semester column exists, if not add it
        if (!Schema::hasColumn('projects', 'semester')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->enum('semester', ['Fall', 'Spring', 'Summer School'])->default('Fall')->after('project_type');
            });
        } else {
            // Update existing semester values
            DB::table('projects')
                ->where('semester', '1. Semester')
                ->update(['semester' => 'Fall']);
                
            DB::table('projects')
                ->where('semester', '2. Semester')
                ->update(['semester' => 'Spring']);
            
            // Modify the semester column to use new enum values
            DB::statement("ALTER TABLE projects MODIFY COLUMN semester ENUM('Fall', 'Spring', 'Summer School') DEFAULT 'Fall'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert semester values
        DB::table('projects')
            ->where('semester', 'Fall')
            ->update(['semester' => '1. Semester']);
            
        DB::table('projects')
            ->where('semester', 'Spring')
            ->update(['semester' => '2. Semester']);
        
        // Revert the semester column to old enum values
        DB::statement("ALTER TABLE projects MODIFY COLUMN semester ENUM('1. Semester', '2. Semester') DEFAULT '1. Semester'");
    }
};
