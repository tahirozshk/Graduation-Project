<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'year',
        'department',
        'status',
    ];

    /**
     * Get the supervisor groups for the student.
     */
    public function supervisorGroups()
    {
        return $this->hasMany(SupervisorGroup::class);
    }

    /**
     * Get the teachers through supervisor groups.
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'supervisor_groups', 'student_id', 'teacher_id');
    }

    /**
     * Get the project groups for the student.
     */
    public function projectGroups()
    {
        return $this->hasMany(ProjectGroup::class);
    }

    /**
     * Get the projects through project groups.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_groups', 'student_id', 'project_id');
    }
}

