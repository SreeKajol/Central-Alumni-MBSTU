# 🎓 Central Alumni MBSTU

A comprehensive Laravel-based platform for managing alumni of Mawlana Bhashani Science and Technology University (MBSTU), including departments, events, and communications.

## Features

### Core Features
- **Multi-Role System**: Super Admin, Department Admin, Alumni, and Guest roles
- **Department Management**: Dedicated pages for each department
- **Alumni Profiles**: Complete profiles with photos, education, career info
- **Events & News**: University-wide and departmental announcements
- **Responsive Dashboard**: Modern UI with sliding sidebar navigation
- **Search & Filter**: Advanced alumni directory search

### 🤖 NEW: AI-Powered Features (Java Microservice)
- **Smart Recommendations**: ML-based alumni networking suggestions
- **Mentorship Matching**: Connect with senior alumni mentors
- **Career Analytics**: Industry trends and insights dashboard
- **Batchmate Discovery**: Find and reconnect with classmates
- **Multi-factor Scoring**: Intelligent similarity algorithm

## Requirements

### Laravel Application
- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & NPM

### Java Microservice (Optional - for AI features)
- Java JDK 17+
- Apache Maven 3.6+

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

### Optional: Java Microservice Setup

For AI-powered recommendations and analytics:

```bash
# Navigate to microservice directory
cd alumni-intelligence-service

# Build and start the Java service
./start-service.sh

# Or manually:
mvn clean install
mvn spring-boot:run
```

**See [JAVA_INTEGRATION_GUIDE.md](JAVA_INTEGRATION_GUIDE.md) for detailed documentation.**

## Default Credentials

After seeding:
- **Super Admin**: admin@alumni.edu / password
- **Department Admin**: dept@cse.edu / password
- **Alumni**: alumni@example.com / password

## Technology Stack

### Laravel Application
- **Backend**: Laravel 11
- **Frontend**: Blade Templates, TailwindCSS, Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Lucide Icons

### Java Microservice
- **Framework**: Spring Boot 3.2
- **Language**: Java 17
- **ORM**: Spring Data JPA (Hibernate)
- **Algorithms**: Apache Commons Math
- **Build Tool**: Maven

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
✅ **Phase 8: Java Microservice Integration (AI Features)**

## Documentation

📖 **[Complete Documentation](DOCUMENTATION.md)** - Everything you need to know

Includes:
- Installation & Setup
- User Guides (Alumni & Admins)
- Features Overview
- Career Analytics Dashboard
- Troubleshooting
- Recent Updates & Fixes

## License

MIT License
