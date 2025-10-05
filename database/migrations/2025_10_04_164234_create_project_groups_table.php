<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('student_id');
            $table->string('role')->default('Member'); // Leader, Member, Observer
            $table->timestamps();

            // Foreign keys (as requested in the diagram)
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('student_id')->references('id')->on('students');
            
            // Unique constraint to prevent duplicate assignments
            $table->unique(['project_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_groups');
    }
};
