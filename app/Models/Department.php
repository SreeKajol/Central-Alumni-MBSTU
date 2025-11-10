<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'head_name',
        'contact_email',
        'contact_phone',
        'logo',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function alumniProfiles()
    {
        return $this->hasMany(AlumniProfile::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function departmentAdmins()
    {
        return $this->hasMany(User::class)
            ->where('role', 'department_admin');
    }

    // Helper methods
    public function getAlumniCountAttribute(): int
    {
        return $this->alumniProfiles()->count();
    }
}
