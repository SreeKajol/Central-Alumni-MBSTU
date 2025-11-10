<?php

namespace App\Policies;

use App\Models\AlumniProfile;
use App\Models\User;

class AlumniProfilePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, AlumniProfile $alumniProfile): bool
    {
        if ($alumniProfile->is_profile_public) {
            return true;
        }

        return $user && $user->id === $alumniProfile->user_id;
    }

    public function create(User $user): bool
    {
        return $user->isAlumni() && !$user->alumniProfile;
    }

    public function update(User $user, AlumniProfile $alumniProfile): bool
    {
        return $user->id === $alumniProfile->user_id 
            || $user->isSuperAdmin()
            || $user->canManageDepartment($alumniProfile->department);
    }

    public function delete(User $user, AlumniProfile $alumniProfile): bool
    {
        return $user->id === $alumniProfile->user_id || $user->isSuperAdmin();
    }

    public function verify(User $user, AlumniProfile $alumniProfile): bool
    {
        return $user->isSuperAdmin() 
            || $user->canManageDepartment($alumniProfile->department);
    }
}
