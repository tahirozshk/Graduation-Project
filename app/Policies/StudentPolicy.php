<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    /**
     * Determine if the given student can be viewed by the user.
     */
    public function view(User $user, Student $student): bool
    {
        return $user->id === $student->teacher_id;
    }

    /**
     * Determine if the given student can be updated by the user.
     */
    public function update(User $user, Student $student): bool
    {
        return $user->id === $student->teacher_id;
    }

    /**
     * Determine if the given student can be deleted by the user.
     */
    public function delete(User $user, Student $student): bool
    {
        return $user->id === $student->teacher_id;
    }
}

