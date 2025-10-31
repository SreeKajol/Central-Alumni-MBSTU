# ⚡ Quick Start Guide

## 🚀 5-Minute Setup

### Step 1: Install Dependencies
```bash
cd c:\Users\kajol\OneDrive\Desktop\Project\alumni-system
composer install
npm install
```

### Step 2: Configure Environment
```bash
copy .env.example .env
php artisan key:generate
```

Edit `.env` and set your database:
```env
DB_DATABASE=alumni_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 3: Setup Database
```bash
# Create database 'alumni_system' in MySQL first
php artisan migrate --seed
php artisan storage:link
```

### Step 4: Run Application
```bash
# Terminal 1: Build assets
npm run dev

# Terminal 2: Start server
php artisan serve
```

### Step 5: Access Application
Open browser: **http://127.0.0.1:8000**

---

## 👤 Login Credentials

**Super Admin:**
- Email: `admin@alumni.edu`
- Password: `password`

**Department Admin:**
- Email: `cse@university.edu`
- Password: `password`

**Alumni:**
- Email: `alice@example.com`
- Password: `password`

---

## 🎯 What You Can Do

### As Super Admin:
- ✅ Manage all departments
- ✅ Create/edit events and news
- ✅ Verify alumni profiles
- ✅ Access all features

### As Department Admin:
- ✅ Manage your department
- ✅ Create department events
- ✅ Post department news
- ✅ View department alumni

### As Alumni:
- ✅ Create your profile
- ✅ Register for events
- ✅ View other alumni
- ✅ Connect with batchmates

---

## 📂 Key Files

| File | Purpose |
|------|---------|
| `routes/web.php` | All application routes |
| `app/Models/*.php` | Database models |
| `app/Http/Controllers/*.php` | Application logic |
| `resources/views/**/*.blade.php` | UI templates |
| `database/seeders/DatabaseSeeder.php` | Sample data |

---

## 🐛 Troubleshooting

**Issue:** Can't access website
```bash
# Check if server is running
php artisan serve
```

**Issue:** CSS not loading
```bash
# Run Vite dev server
npm run dev
```

**Issue:** Database errors
```bash
# Reset database
php artisan migrate:fresh --seed
```

**Issue:** Images not showing
```bash
# Create storage symlink
php artisan storage:link
```

---

## 📚 Full Documentation

See `INSTALLATION.md` and `PROJECT_SUMMARY.md` for complete details.

---

## ✅ Feature Checklist

- ✅ Authentication (Login/Register)
- ✅ Dashboard with sliding sidebar
- ✅ Department management
- ✅ Alumni profiles with search
- ✅ Events with registration
- ✅ News & announcements
- ✅ Role-based permissions
- ✅ Responsive design
- ✅ Sample data included

---

**Ready to explore! 🎉**
