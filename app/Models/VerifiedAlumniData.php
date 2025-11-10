<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifiedAlumniData extends Model
{
    use HasFactory;

    protected $table = 'verified_alumni_data';

    protected $fillable = [
        'student_id',
        'email',
        'full_name',
        'batch_year',
        'graduation_year',
        'degree',
        'phone',
        'is_used',
    ];

    protected function casts(): array
    {
        return [
            'is_used' => 'boolean',
            'batch_year' => 'integer',
            'graduation_year' => 'integer',
        ];
    }

    // Mutators
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    // Helper Methods
    public static function verifyAlumni(string $email, string $studentId): ?self
    {
        return self::where('email', $email)
            ->where('student_id', $studentId)
            ->where('is_used', false)
            ->first();
    }

    public function markAsUsed(): void
    {
        $this->update(['is_used' => true]);
    }
}
