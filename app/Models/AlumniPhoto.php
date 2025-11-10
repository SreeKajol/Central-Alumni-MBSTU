<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AlumniPhoto extends Model
{
    protected $fillable = [
        'title',
        'description',
        'photo_path',
        'event_name',
        'event_date',
        'location',
        'year',
        'category',
        'uploaded_by',
        'is_featured',
        'is_published',
        'views',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getPhotoUrlAttribute()
    {
        // If path starts with 'http' or 'https', return as is (external URL)
        if (str_starts_with($this->photo_path, 'http')) {
            return $this->photo_path;
        }
        
        // Otherwise, treat as public path
        return asset($this->photo_path);
    }
}
