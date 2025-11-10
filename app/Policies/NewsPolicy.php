<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;

class NewsPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, News $news): bool
    {
        if ($news->is_published) {
            return true;
        }

        return $user && (
            $user->isSuperAdmin() 
            || $user->id === $news->user_id
            || ($news->department_id && $user->canManageDepartment($news->department))
        );
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isDepartmentAdmin();
    }

    public function update(User $user, News $news): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($news->department_id) {
            return $user->canManageDepartment($news->department);
        }

        return $user->id === $news->user_id;
    }

    public function delete(User $user, News $news): bool
    {
        return $this->update($user, $news);
    }
}
