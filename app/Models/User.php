<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function alumniProfile()
    {
        return $this->hasOne(AlumniProfile::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_registrations')
            ->withTimestamps();
    }

    // Helper methods
    public function isSuperAdmin(): bool
    {
        return $this->role === UserRole::SUPER_ADMIN;
    }

    public function isDepartmentAdmin(): bool
    {
        return $this->role === UserRole::DEPARTMENT_ADMIN;
    }

    public function isAlumni(): bool
    {
        return $this->role === UserRole::ALUMNI;
    }

    public function canManageDepartment(Department $department = null): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isDepartmentAdmin() && $department) {
            return $this->department_id === $department->id;
        }

        return false;
    }
}
