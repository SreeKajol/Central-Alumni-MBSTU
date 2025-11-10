<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'title',
        'description',
        'event_type',
        'event_date',
        'event_time',
        'location',
        'venue',
        'registration_deadline',
        'max_participants',
        'image',
        'is_public',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'registration_deadline' => 'datetime',
            'is_public' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function registrations()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
            ->withTimestamps();
    }

    // Helper methods
    public function getRegistrationCountAttribute(): int
    {
        return $this->registrations()->count();
    }

    public function isRegistrationOpen(): bool
    {
        return $this->registration_deadline 
            ? $this->registration_deadline->isFuture()
            : true;
    }

    public function hasAvailableSlots(): bool
    {
        if (!$this->max_participants) {
            return true;
        }

        return $this->registrationCount < $this->max_participants;
    }

    public function userIsRegistered(User $user): bool
    {
        return $this->registrations()->where('user_id', $user->id)->exists();
    }
}
