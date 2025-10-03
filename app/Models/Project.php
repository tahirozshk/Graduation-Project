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
        'student_id',
        'title',
        'description',
        'project_type',
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
     * Get the student that owns the project.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the reports for the project.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}

