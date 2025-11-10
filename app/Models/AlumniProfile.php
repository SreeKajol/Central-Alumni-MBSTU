<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'student_id',
        'batch_year',
        'graduation_year',
        'degree',
        'major',
        'profile_photo',
        'date_of_birth',
        'phone',
        'address',
        'city',
        'country',
        'current_company',
        'current_position',
        'industry',
        'linkedin_url',
        'facebook_url',
        'twitter_url',
        'website_url',
        'bio',
        'achievements',
        'publications',
        'is_profile_public',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'is_profile_public' => 'boolean',
            'is_verified' => 'boolean',
            'achievements' => 'array',
            'publications' => 'array',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Helper methods
    public function getFullNameAttribute(): string
    {
        return $this->user->name;
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->profile_photo 
            ? asset('storage/' . $this->profile_photo)
            : asset('images/default-avatar.png');
    }

    public function getBatchMates()
    {
        return self::where('department_id', $this->department_id)
            ->where('batch_year', $this->batch_year)
            ->where('id', '!=', $this->id)
            ->get();
    }
}
