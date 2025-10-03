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
        'teacher_id',
        'name',
        'email',
        'year',
        'department',
        'status',
    ];

    /**
     * Get the teacher that owns the student.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the projects for the student.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

