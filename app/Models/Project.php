<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'project_type',
        'semester',
        'start_date',
        'end_date',
        'progress',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * Get the project groups for the project.
     */
    public function projectGroups()
    {
        return $this->hasMany(ProjectGroup::class);
    }

    /**
     * Get the students through project groups.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'project_groups', 'project_id', 'student_id');
    }

    /**
     * Get the reports for the project.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get the first student for the project (for backward compatibility).
     * This is useful when you need a single student reference.
     */
    public function student()
    {
        return $this->belongsToMany(Student::class, 'project_groups', 'project_id', 'student_id')
            ->limit(1);
    }
}

