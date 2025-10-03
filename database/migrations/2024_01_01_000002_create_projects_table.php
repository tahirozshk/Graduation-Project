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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('project_type', ['Research', 'Development'])->default('Research');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('progress')->default(0);
            $table->enum('status', ['Planning', 'In Progress', 'Review', 'Completed'])->default('Planning');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

