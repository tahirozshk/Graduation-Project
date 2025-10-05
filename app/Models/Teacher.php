<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'approved_at',
        'approved_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'approved_at' => 'datetime',
        ];
    }

    /**
     * Get the supervisor groups for the teacher.
     */
    public function supervisorGroups()
    {
        return $this->hasMany(SupervisorGroup::class);
    }

    /**
     * Get the students through supervisor groups.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'supervisor_groups', 'teacher_id', 'student_id');
    }

    /**
     * Get the notifications for the teacher.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Check if teacher is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if teacher is pending approval.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Get the user who approved this teacher.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
