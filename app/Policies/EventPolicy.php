<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Event $event): bool
    {
        if ($event->is_public) {
            return true;
        }

        return $user && (
            $user->isSuperAdmin() 
            || ($event->department_id && $user->canManageDepartment($event->department))
        );
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isDepartmentAdmin();
    }

    public function update(User $user, Event $event): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($event->department_id) {
            return $user->canManageDepartment($event->department);
        }

        return false;
    }

    public function delete(User $user, Event $event): bool
    {
        return $this->update($user, $event);
    }
}
