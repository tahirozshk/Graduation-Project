<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;

class NotificationPolicy
{
    /**
     * Determine if the given notification can be updated by the user.
     */
    public function update(User $user, Notification $notification): bool
    {
        return $user->id === $notification->teacher_id;
    }

    /**
     * Determine if the given notification can be deleted by the user.
     */
    public function delete(User $user, Notification $notification): bool
    {
        return $user->id === $notification->teacher_id;
    }
}

