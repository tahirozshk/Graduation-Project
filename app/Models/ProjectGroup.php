<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'student_id',
        'role',
    ];

    /**
     * Get the project that owns the project group.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the student that belongs to the project group.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
