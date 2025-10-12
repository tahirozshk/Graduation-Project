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
        Schema::table('projects', function (Blueprint $table) {
            // First, change project_type to string temporarily
            $table->string('project_type', 50)->change();
        });
        
        // Update existing data to match new enum values
        DB::table('projects')
            ->where('project_type', 'Research')
            ->update(['project_type' => 'Internship I']);
            
        DB::table('projects')
            ->where('project_type', 'Development')
            ->update(['project_type' => 'Internship II']);
        
        Schema::table('projects', function (Blueprint $table) {
            // Add semester column with default value if it doesn't exist
            if (!Schema::hasColumn('projects', 'semester')) {
                $table->enum('semester', ['Fall', 'Spring', 'Summer School'])->default('Fall')->after('project_type');
            }
            
            // Update project_type to new enum values
            $table->enum('project_type', ['Internship I', 'Internship II', 'Graduation I', 'Graduation II'])->default('Internship I')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Remove semester column if exists
            if (Schema::hasColumn('projects', 'semester')) {
                $table->dropColumn('semester');
            }
            
            // Revert project_type enum to old values
            $table->enum('project_type', ['Research', 'Development'])->default('Research')->change();
        });
    }
};
