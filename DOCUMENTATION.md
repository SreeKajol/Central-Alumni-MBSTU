# 📚 Central Alumni MBSTU - Complete Documentation

## Table of Contents
1. [Quick Start](#quick-start)
2. [Installation](#installation)
3. [Features](#features)
4. [Usage Guide](#usage-guide)
5. [Troubleshooting](#troubleshooting)
6. [Recent Updates](#recent-updates)

---

## Quick Start

### Access the Application
```
http://127.0.0.1:8000
```

### Default Credentials
- **Super Admin**: `admin@alumni.edu` / `password`
- **Department Admin**: `dept@cse.edu` / `password`  
- **Alumni**: `alumni@example.com` / `password`

### Key URLs
- Dashboard: `/dashboard`
- Alumni Directory: `/alumni`
- Departments: `/departments`
- Events: `/events`
- News: `/news`
- Career Analytics: `/analytics/career`
- Recommendations: `/recommendations`

---

## Installation

### 1. Laravel Setup
```bash
# Clone and install
composer install
npm install

# Environment
cp .env.example .env
php artisan key:generate

# Database setup (configure .env first)
php artisan migrate --seed

# Start servers
npm run dev          # Frontend
php artisan serve    # Backend (http://127.0.0.1:8000)
```

### 2. Optional: Java Microservice (AI Features)
```bash
cd alumni-intelligence-service
./start-service.sh
# Or manually: mvn clean install && mvn spring-boot:run
```

---

## Features

### 1. Alumni Management
- Create and manage alumni profiles
- Photo uploads and career information
- Department-wise organization
- Profile verification system
- Public/private profile settings

### 2. Department System
- Multiple departments (CSE, EEE, etc.)
- Department-specific admins
- Departmental news and events

### 3. Events & News
- Create and manage events
- Event registration system
- News announcements
- Image uploads for events/news

### 4. User Roles
- **Super Admin**: Full system access
- **Department Admin**: Manage specific department
- **Alumni**: Create profile, register for events
- **Guest**: Browse public content

### 5. Career Analytics Dashboard
**URL**: `/analytics/career`

**Features**:
- Total alumni statistics
- Verified alumni count
- Employment rate tracking
- Industry distribution analysis
- Top companies employing alumni
- Most common job positions
- Graduation year trends
- Geographic distribution (cities & countries)
- Department-wise filtering

**Visual Elements**:
- 5 summary cards with gradients
- Industry breakdown with progress bars
- Company listings with badges
- Position distribution grid
- Interactive bar charts
- Location-based analytics

---

## Usage Guide

### For Alumni Users

#### 1. Register
- Use verified alumni email (must be pre-approved)
- Provide student ID for verification
- Create account with password

#### 2. Create Profile
- Navigate to `/alumni/create`
- Fill in required information:
  - Department and batch year
  - Graduation year and degree
  - Current employment details
  - Contact information
  - Social media links
- Upload profile photo
- Set profile visibility (public/private)

#### 3. Update Profile
- Go to alumni directory
- Click on your profile
- Click "Edit Profile"
- Update information
- Save changes

#### 4. Browse Alumni
- Visit `/alumni`
- Use search filters:
  - Department
  - Batch year
  - Graduation year
  - Industry
- View public profiles
- Connect with batchmates

#### 5. Event Registration
- Browse events at `/events`
- Click "Register" on events
- View registered events in dashboard

### For Administrators

#### Super Admin Tasks
1. **Manage Departments**
   - Create/edit/delete departments
   - Assign department admins

2. **Verify Alumni Profiles**
   - Review pending profiles
   - Approve/reject verifications

3. **Manage Events & News**
   - Create university-wide announcements
   - Manage all departments' content

4. **View Analytics**
   - Access career analytics dashboard
   - Filter by department
   - Export reports (if needed)

#### Department Admin Tasks
1. **Manage Department Content**
   - Create department-specific events
   - Post departmental news

2. **Verify Department Alumni**
   - Approve alumni from your department

3. **Monitor Department Analytics**
   - View department-specific statistics
   - Track alumni career progress

---

## Troubleshooting

### Common Issues

#### 1. Login Issues
**Problem**: Email cannot log in

**Solutions**:
```bash
# Check if user exists
php artisan tinker
>>> User::where('email', 'your@email.com')->first();

# Check email case sensitivity (fixed)
# Emails are now automatically lowercase
```

#### 2. Profile Update Deletes Instead
**Fixed**: Nested forms issue resolved
- Delete button now separate from update form
- Both actions work independently

#### 3. Alumni Not Visible
**Fixed**: Policy and query issues resolved
- Public profiles now visible to all
- Private profiles only visible to owner

#### 4. Email Case Sensitivity
**Fixed**: All emails converted to lowercase
- Login accepts any case
- Database stores lowercase
- Consistent across registration

#### 5. Missing Profile After Login
**Fixed**: Redirect to profile creation
- Users without profiles redirected to `/alumni/create`
- No longer blocked from logging in

### Database Issues

#### Reset Database
```bash
php artisan migrate:fresh --seed
```

#### Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### Check Database Connection
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

### Frontend Issues

#### Assets Not Loading
```bash
npm run build
php artisan storage:link
```

#### Styles Not Applying
```bash
npm run dev
# Or for production:
npm run build
```

---

## Recent Updates

### ✅ Latest Fixes (November 2025)

#### 1. Alumni Profile Updates
- **Fixed**: Nested form bug causing deletion on update
- **Fixed**: Profile visibility issues
- **Improved**: Edit form UX

#### 2. Login System
- **Fixed**: Email case sensitivity
- **Fixed**: Missing profile redirect
- **Added**: Lowercase email conversion
- **Improved**: Error messages

#### 3. Career Analytics Dashboard
- **Added**: Comprehensive analytics page at `/analytics/career`
- **Features**: 
  - 5 summary statistic cards
  - Industry distribution visualization
  - Top companies analysis
  - Job position trends
  - Geographic distribution
  - Department filtering
- **Design**: Modern gradient UI with animations
- **Performance**: Works without Java microservice (uses local data)

#### 4. CSS Improvements
- **Enhanced**: All card gradients (3-color transitions)
- **Added**: Hover animations and effects
- **Improved**: Color harmony and contrast
- **Updated**: Typography and spacing
- **Added**: Backdrop blur effects on icons

#### 5. Database Models
- **Fixed**: User email mutator
- **Fixed**: Nullable parameter warnings
- **Updated**: VerifiedAlumniData email handling

---

## Technical Details

### Models & Relationships
```
User
├── hasOne: AlumniProfile
├── belongsTo: Department
└── belongsToMany: Events

AlumniProfile
├── belongsTo: User
├── belongsTo: Department
└── methods: getBatchMates()

Department
├── hasMany: Users
├── hasMany: AlumniProfiles
├── hasMany: Events
└── hasMany: News
```

### Policies
- `AlumniProfilePolicy`: Controls profile access and editing
- Authorization checks on update/delete actions
- Role-based permissions

### Routes
```
Public:
- GET  /
- GET  /alumni (index)
- GET  /alumni/{id} (show public profiles)
- GET  /departments
- GET  /events
- GET  /news

Authenticated:
- Dashboard, profile management
- Event registration
- Alumni profile CRUD
- Admin functions
- Analytics dashboard
```

### Environment Configuration
```env
# Required
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alumni_mbstu
DB_USERNAME=root
DB_PASSWORD=

# Optional (for Java microservice)
ALUMNI_INTELLIGENCE_URL=http://localhost:8081/api
```

---

## Best Practices

### For Development
1. Always clear cache after changes: `php artisan optimize:clear`
2. Run migrations safely: Check before `migrate:fresh`
3. Test on different browsers
4. Use proper validation in forms
5. Follow PSR-12 coding standards

### For Production
1. Set `APP_DEBUG=false`
2. Use `php artisan config:cache`
3. Run `npm run build` for assets
4. Enable HTTPS
5. Regular database backups
6. Use queue workers for emails
7. Set proper file permissions

---

## Support & Contribution

### Getting Help
1. Check this documentation first
2. Review error logs: `storage/logs/laravel.log`
3. Check browser console for frontend errors
4. Use `php artisan tinker` for debugging

### File Structure Reference
```
app/
├── Http/Controllers/
│   ├── AlumniController.php (profile management)
│   ├── DepartmentController.php
│   ├── EventController.php
│   ├── NewsController.php
│   └── RecommendationController.php (analytics)
├── Models/
│   ├── User.php
│   ├── AlumniProfile.php
│   ├── Department.php
│   ├── Event.php
│   └── News.php
└── Policies/
    └── AlumniProfilePolicy.php

resources/views/
├── layouts/app.blade.php (main layout)
├── dashboard/index.blade.php
├── alumni/
│   ├── index.blade.php (directory)
│   ├── show.blade.php (profile view)
│   ├── create.blade.php
│   └── edit.blade.php
└── recommendations/
    └── analytics.blade.php (career analytics)

routes/
└── web.php (all application routes)
```

---

## License
MIT License - Feel free to use and modify for your institution.

---

**Last Updated**: November 10, 2025  
**Version**: 2.0  
**Status**: Production Ready ✅
