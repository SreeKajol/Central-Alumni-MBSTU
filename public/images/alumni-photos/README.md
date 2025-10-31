# Alumni Photo Archive - Sample Images

This directory contains sample placeholder images for the Alumni Photo Archive.

## Current Sample Photos

- `reunion2024.jpg` - Annual Alumni Reunion
- `graduation2023.jpg` - Graduation Ceremony
- `cultural.jpg` - Cultural Program
- `sports.jpg` - Sports Day
- `campus.jpg` - Campus Memories
- `meet2022.jpg` - Alumni Meet
- `sciencefair.jpg` - Science Fair
- `farewell.jpg` - Farewell Ceremony

## How to Replace with Original Photos

### Option 1: Replace Existing Files
Simply replace the files in this directory with your original photos, keeping the same filenames.

### Option 2: Add New Photos via Database

1. **Upload new photos** to this directory (`public/images/alumni-photos/`)

2. **Add database records** using Laravel Tinker:
```bash
php artisan tinker
```

Then run:
```php
App\Models\AlumniPhoto::create([
    'title' => 'Your Photo Title',
    'description' => 'Description of the event or memory',
    'photo_path' => 'images/alumni-photos/your-photo-name.jpg',
    'event_name' => 'Event Name (optional)',
    'event_date' => '2024-10-31', // optional
    'location' => 'Location (optional)',
    'year' => 2024,
    'category' => 'reunion', // reunion, event, ceremony, campus, sports, cultural, graduation
    'is_featured' => false, // true for featured photos
    'is_published' => true
]);
```

### Option 3: Bulk Update via Seeder

Edit `database/seeders/AlumniPhotoSeeder.php` and run:
```bash
php artisan db:seed --class=AlumniPhotoSeeder
```

## Photo Categories

- **reunion** - Alumni reunion events
- **event** - General alumni events
- **ceremony** - Award ceremonies, formal events
- **campus** - Campus life and memories
- **sports** - Sports events and achievements
- **cultural** - Cultural programs and performances
- **graduation** - Graduation and convocation ceremonies

## Notes

- Photos are served from the public directory via `asset()` helper
- Recommended image format: JPG or PNG
- Recommended size: 800-2000px width for good quality
- The masonry layout will automatically adjust to different image aspect ratios
