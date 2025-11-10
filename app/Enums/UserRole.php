<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'super_admin';
    case DEPARTMENT_ADMIN = 'department_admin';
    case ALUMNI = 'alumni';
    case GUEST = 'guest';

    public function label(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'Super Administrator',
            self::DEPARTMENT_ADMIN => 'Department Administrator',
            self::ALUMNI => 'Alumni',
            self::GUEST => 'Guest',
        };
    }

    public function canManageAllDepartments(): bool
    {
        return $this === self::SUPER_ADMIN;
    }

    public function canManageDepartment(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::DEPARTMENT_ADMIN]);
    }

    public function canCreateAlumniProfile(): bool
    {
        return $this === self::ALUMNI;
    }
}
