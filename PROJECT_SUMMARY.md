# 🎓 Central Alumni MBSTU - Project Summary

## 📌 Project Overview

A comprehensive web-based **Alumni Management System** for **Mawlana Bhashani Science and Technology University (MBSTU)** built with **Laravel 11**, featuring department management, alumni profiles, events, news, and a beautiful sliding sidebar dashboard interface.

---

## ✅ Completed Features

### 1. **Authentication System** ✓
- User registration and login
- Password reset functionality
- Email verification support
- Role-based authentication (Super Admin, Department Admin, Alumni, Guest)
- Profile management with password update
- Account deletion

### 2. **Multi-Role System** ✓
- **Super Admin**: Full system control, manages all departments
- **Department Admin**: Manages specific department, can create events/news
- **Alumni**: Can create profile, register for events
- **Guest**: View-only access to public content

### 3. **Dashboard with Sliding Sidebar** ✓
- Responsive sliding sidebar navigation
- Collapsible menu (desktop) / slide-in-out (mobile)
- State persistence using localStorage
- Beautiful gradient stat cards
- Recent news and upcoming events
- Role-specific statistics

### 4. **Department Management** ✓
- Full CRUD operations (Create, Read, Update, Delete)
- Department profiles with:
  - Logo upload
  - Contact information
  - Department head details
  - Description
- Alumni count per department
- Department-specific pages showing:
  - Alumni list
  - Upcoming events
  - Recent news

### 5. **Alumni Profile System** ✓
- Comprehensive profile creation with:
  - Personal information (name, photo, DOB, contact)
  - Education details (degree, major, batch, graduation year)
  - Career information (company, position, industry)
  - Social media links (LinkedIn, Facebook, Twitter, Website)
  - Bio and achievements
  - Privacy controls (public/private profiles)
- Profile verification system
- Batchmate discovery
- Advanced search and filtering:
  - By name
  - By department
  - By batch year
  - By industry

### 6. **Events Management** ✓
- Event creation and management
- Event types (reunion, seminar, career fair, etc.)
- Department-specific and university-wide events
- Event registration system with capacity limits
- Registration deadline tracking
- Upcoming and past events views
- Event details with:
  - Date, time, location, venue
  - Image upload
  - Description
  - Participant list

### 7. **News & Announcements** ✓
- News article creation and management
- Featured news highlighting
- Department-specific and university-wide news
- Rich content with images
- Article slugs for SEO-friendly URLs
- Author attribution
- Publication status (draft/published)
- Related articles section

### 8. **Authorization & Security** ✓
- Policy-based authorization
- Role-specific permissions
- Super Admin implicit access to all features
- Department-level access control
- Profile ownership validation
- CSRF protection
- Password hashing

---

## 🏗️ Technical Architecture

### **Backend**
- **Framework**: Laravel 11
- **Authentication**: Custom Laravel authentication
- **Database**: MySQL with Eloquent ORM
- **Authorization**: Laravel Policies
- **File Storage**: Laravel Storage (for images)

### **Frontend**
- **Template Engine**: Blade
- **CSS Framework**: TailwindCSS 3.4
- **JavaScript**: Alpine.js 3.14, Vanilla JS
- **Build Tool**: Vite
- **Icons**: SVG icons (inline)
- **Responsive Design**: Mobile-first approach

### **Database Schema**
```
users
├── id
├── name
├── email
├── password
├── role (enum)
├── department_id (nullable)
└── timestamps

departments
├── id
├── name
├── code (unique)
├── description
├── head_name
├── contact_email
├── contact_phone
├── logo
└── timestamps

alumni_profiles
├── id
├── user_id
├── department_id
├── student_id
├── batch_year
├── graduation_year
├── degree, major
├── profile_photo
├── contact info (phone, address, city, country)
├── career info (company, position, industry)
├── social links (linkedin, facebook, twitter, website)
├── bio, achievements, publications
└── timestamps

events
├── id
├── department_id (nullable)
├── title, description
├── event_type, event_date, event_time
├── location, venue
├── registration_deadline
├── max_participants
└── timestamps

news
├── id
├── department_id (nullable)
├── user_id (author)
├── title, slug, content, excerpt
├── image
├── is_featured, is_published
└── timestamps

messages
├── id
├── sender_id, receiver_id
├── subject, body
└── timestamps
```

---

## 📁 Project Structure

```
alumni-system/
├── app/
│   ├── Enums/
│   │   └── UserRole.php                  # Role enumeration
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                     # Authentication controllers
│   │   │   ├── DashboardController.php
│   │   │   ├── DepartmentController.php
│   │   │   ├── AlumniController.php
│   │   │   ├── EventController.php
│   │   │   ├── NewsController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php        # Role-based access control
│   ├── Models/
│   │   ├── User.php
│   │   ├── Department.php
│   │   ├── AlumniProfile.php
│   │   ├── Event.php
│   │   ├── News.php
│   │   └── Message.php
│   ├── Policies/
│   │   ├── DepartmentPolicy.php
│   │   ├── AlumniProfilePolicy.php
│   │   ├── EventPolicy.php
│   │   └── NewsPolicy.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── AuthServiceProvider.php
├── database/
│   ├── migrations/                       # All database migrations
│   └── seeders/
│       └── DatabaseSeeder.php            # Sample data seeder
├── resources/
│   ├── css/
│   │   └── app.css                       # TailwindCSS + custom styles
│   ├── js/
│   │   ├── app.js                        # Main JavaScript
│   │   └── bootstrap.js                  # Axios configuration
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php             # Main layout
│       │   └── sidebar.blade.php         # Sidebar component
│       ├── auth/                         # Authentication views
│       ├── dashboard.blade.php
│       ├── welcome.blade.php
│       ├── departments/                  # Department views
│       ├── alumni/                       # Alumni views
│       ├── events/                       # Event views
│       ├── news/                         # News views
│       └── profile/                      # Profile settings
├── routes/
│   ├── web.php                           # Web routes
│   ├── auth.php                          # Auth routes
│   └── console.php                       # Console routes
└── public/                               # Public assets
```

---

## 🎨 UI/UX Features

### **Sidebar Navigation**
- Smooth slide-in/slide-out animation
- Collapsible on desktop (saves state)
- Mobile-friendly overlay
- Active menu highlighting
- Icons for all menu items

### **Color Scheme**
- Primary: Blue (#3b82f6 - #1e3a8a)
- Success: Green
- Warning: Yellow
- Danger: Red
- Background: Gray gradients

### **Responsive Design**
- Mobile-first approach
- Breakpoints: sm (640px), md (768px), lg (1024px)
- Grid layouts that adapt
- Touch-friendly mobile interface

### **Interactive Elements**
- Hover effects on cards
- Smooth transitions
- Auto-dismissing flash messages
- Image preview on upload
- Confirmation dialogs for destructive actions

---

## 📊 Seeded Sample Data

After running migrations with seed, you get:

### **Departments** (5)
- Computer Science & Engineering (CSE)
- Electrical & Electronic Engineering (EEE)
- Business Administration (BBA)
- Civil Engineering (CE)
- English (ENG)

### **Users** (9)
1. Super Admin
2. 5 Department Admins (one per department)
3. 3 Alumni users (CSE department)

### **Alumni Profiles** (3)
- Complete profiles with education and career info
- Different batch years
- Working at Google, Microsoft, Amazon

### **Events** (2)
- CSE Alumni Reunion 2024
- Career Fair 2024 (university-wide)

### **News** (2)
- New Research Lab Inaugurated (CSE)
- University Celebrates 50 Years (university-wide)

---

## 🔐 Default Credentials

```
Super Admin:
Email: admin@alumni.edu
Password: password

Department Admin (CSE):
Email: cse@university.edu
Password: password

Alumni:
Email: alice@example.com
Password: password
```

---

## 🚀 Getting Started

### **Prerequisites**
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL 8.0+

### **Quick Start**
```bash
# 1. Navigate to project
cd c:\Users\kajol\OneDrive\Desktop\Project\alumni-system

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure database in .env file
# DB_DATABASE=alumni_system
# DB_USERNAME=root
# DB_PASSWORD=your_password

# 5. Run migrations with seed data
php artisan migrate --seed

# 6. Create storage link
php artisan storage:link

# 7. Build assets
npm run dev

# 8. Start server (in new terminal)
php artisan serve

# Visit: http://127.0.0.1:8000
```

---

## 📝 Key Routes

### **Public Routes**
- `/` - Home page
- `/login` - Login
- `/register` - Register
- `/departments` - Department list
- `/alumni` - Alumni directory
- `/events` - Events list
- `/news` - News articles

### **Authenticated Routes**
- `/dashboard` - Main dashboard
- `/profile` - Profile settings
- `/alumni/create` - Create alumni profile
- `/events/{event}/register` - Register for event

### **Admin Routes**
- `/departments/create` - Create department (Super Admin)
- `/events/create` - Create event (Admins)
- `/news/create` - Create news (Admins)

---

## 🎯 Future Enhancement Ideas

The following features are documented but not yet implemented:

1. **Messaging System** - Alumni-to-alumni messaging
2. **Job Board** - Job postings for alumni
3. **Donation Tracking** - Alumni donations
4. **Photo Gallery** - Department and event photos
5. **Alumni Success Stories** - Featured alumni profiles
6. **Email Notifications** - Event reminders, news alerts
7. **Advanced Analytics** - Alumni statistics and reports
8. **Batch-specific Groups** - Virtual reunion spaces
9. **Mentorship Program** - Connect alumni with students
10. **Export Functionality** - PDF/Excel reports

---

## 🛠️ Technologies Used

| Technology | Version | Purpose |
|-----------|---------|---------|
| Laravel | 11.x | Backend framework |
| PHP | 8.2+ | Server-side language |
| MySQL | 8.0+ | Database |
| TailwindCSS | 3.4 | CSS framework |
| Alpine.js | 3.14 | JavaScript reactivity |
| Vite | 5.x | Build tool |
| Blade | - | Template engine |
| Composer | 2.x | PHP dependencies |
| npm | 9.x | Node dependencies |

---

## 📄 License

MIT License - Feel free to use this project for educational or commercial purposes.

---

## 🎓 Project Purpose

This system demonstrates:
- ✅ Full-stack Laravel development
- ✅ Role-based access control
- ✅ RESTful routing and CRUD operations
- ✅ Database relationships (One-to-Many, Many-to-Many)
- ✅ File uploads and storage
- ✅ Modern UI with TailwindCSS
- ✅ Responsive design
- ✅ Authentication and authorization
- ✅ Policy-based permissions
- ✅ Blade templating and components
- ✅ Form validation
- ✅ Database seeding
- ✅ Search and filtering
- ✅ Clean code architecture

---

## 💡 Notes

- The CSS lint warnings about `@tailwind` and `@apply` are expected - these are TailwindCSS directives that work correctly when compiled by PostCSS.
- The project uses PHP Enums (PHP 8.1+) for the UserRole type.
- Storage symlink must be created for image uploads to work.
- All passwords in seeded data use `password` for testing convenience.

---

## 📞 Support

For installation issues, refer to `INSTALLATION.md` for detailed setup instructions.

---

**Built with ❤️ for University Alumni Management**
