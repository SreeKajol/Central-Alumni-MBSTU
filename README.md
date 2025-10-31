# 🎓 Central Alumni MBSTU

A comprehensive Laravel-based platform for managing alumni of Mawlana Bhashani Science and Technology University (MBSTU), including departments, events, and communications.

## Features

- **Multi-Role System**: Super Admin, Department Admin, Alumni, and Guest roles
- **Department Management**: Dedicated pages for each department
- **Alumni Profiles**: Complete profiles with photos, education, career info
- **Events & News**: University-wide and departmental announcements
- **Responsive Dashboard**: Modern UI with sliding sidebar navigation
- **Search & Filter**: Advanced alumni directory search

## Requirements

- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & NPM

## Installation

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
# Then run migrations
php artisan migrate --seed

# Build frontend assets
npm run dev

# Start development server
php artisan serve
```

## Default Credentials

After seeding:
- **Super Admin**: admin@alumni.edu / password
- **Department Admin**: dept@cse.edu / password
- **Alumni**: alumni@example.com / password

## Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, TailwindCSS, Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Lucide Icons

## Project Structure

```
alumni-system/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Enums/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── dashboard/
│   │   ├── departments/
│   │   ├── alumni/
│   │   └── events/
│   └── js/
└── routes/
```

## Development Phases

✅ Phase 1: Authentication & User Management
✅ Phase 2: Database Design & Models
✅ Phase 3: Dashboard UI with Sidebar
✅ Phase 4: Department Management
✅ Phase 5: Alumni Profiles
✅ Phase 6: Events & News
✅ Phase 7: Search & Filters

## License

MIT License
