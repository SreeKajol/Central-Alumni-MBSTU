# 📦 Installation Guide - Central Alumni MBSTU

Follow these steps to set up and run the Central Alumni System for Mawlana Bhashani Science and Technology University (MBSTU) on your local machine.

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 8.2 or higher** (with required extensions)
- **Composer** (PHP dependency manager)
- **Node.js** and **npm** (v16 or higher)
- **MySQL** or **MariaDB** (v8.0 or higher)
- **Git** (optional, for version control)

### Required PHP Extensions
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML

## 🚀 Installation Steps

### Step 1: Navigate to Project Directory
```bash
cd c:\Users\kajol\OneDrive\Desktop\Project\alumni-system
```

### Step 2: Install Composer Dependencies
```bash
composer install
```

If you don't have Composer installed, download it from [getcomposer.org](https://getcomposer.org/)

### Step 3: Install NPM Dependencies
```bash
npm install
```

### Step 4: Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# For Windows Command Prompt, use:
copy .env.example .env
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

### Step 6: Configure Database
Open the `.env` file and update the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alumni_system
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### Step 7: Create Database
Create a MySQL database named `alumni_system`:

**Using MySQL CLI:**
```sql
CREATE DATABASE alumni_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Using phpMyAdmin:**
- Open phpMyAdmin
- Click "New" in the left sidebar
- Enter database name: `alumni_system`
- Select collation: `utf8mb4_unicode_ci`
- Click "Create"

### Step 8: Run Migrations and Seeders
```bash
php artisan migrate --seed
```

This will create all necessary database tables and populate them with sample data.

### Step 9: Create Storage Link
```bash
php artisan storage:link
```

This creates a symbolic link for file uploads (profile photos, department logos, etc.)

### Step 10: Build Frontend Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### Step 11: Start Development Server
Open a new terminal and run:
```bash
php artisan serve
```

The application will be available at: **http://127.0.0.1:8000**

## 👤 Default Login Credentials

After seeding, you can login with these default accounts:

### Super Administrator
- **Email:** admin@alumni.edu
- **Password:** password

### Department Admin (CSE)
- **Email:** cse@university.edu
- **Password:** password

### Alumni User
- **Email:** alice@example.com
- **Password:** password

## 🔧 Troubleshooting

### Issue: "Class not found" errors
**Solution:** Run `composer dump-autoload`

### Issue: "SQLSTATE[HY000] [1045] Access denied"
**Solution:** Check your database credentials in `.env` file

### Issue: "Mix manifest not found"
**Solution:** Run `npm run dev` or `npm run build`

### Issue: "The stream or file could not be opened"
**Solution:** Set proper permissions on storage and cache directories:
```bash
# For Windows (run as Administrator)
icacls storage /grant Users:F /T
icacls bootstrap\cache /grant Users:F /T

# For Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### Issue: "Vite manifest not found"
**Solution:** Keep `npm run dev` running in a separate terminal during development

## 🏗️ Project Structure Overview

```
alumni-system/
├── app/
│   ├── Enums/          # Role enumeration
│   ├── Http/
│   │   ├── Controllers/    # Application controllers
│   │   └── Middleware/     # Custom middleware
│   ├── Models/         # Eloquent models
│   └── Policies/       # Authorization policies
├── database/
│   ├── migrations/     # Database migrations
│   └── seeders/        # Database seeders
├── resources/
│   ├── css/           # Stylesheets (TailwindCSS)
│   ├── js/            # JavaScript files
│   └── views/         # Blade templates
├── routes/
│   ├── web.php        # Web routes
│   └── auth.php       # Authentication routes
└── public/            # Public assets
```

## 🎨 Features Overview

### ✅ Implemented Features
1. **Multi-Role Authentication System**
   - Super Admin
   - Department Admin
   - Alumni
   - Guest

2. **Dashboard with Sliding Sidebar**
   - Responsive design
   - Collapsible menu
   - Mobile-friendly

3. **Department Management**
   - CRUD operations
   - Department pages
   - Alumni listing by department

4. **Alumni Profile Management**
   - Complete profile creation
   - Photo uploads
   - Career information
   - Social media links
   - Search and filter

5. **Events Management**
   - Event creation and management
   - Registration system
   - Department and university-wide events

6. **News & Announcements**
   - News articles
   - Featured news
   - Department-specific news

7. **Role-Based Access Control**
   - Authorization policies
   - Permission-based actions

## 📱 Running in Production

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Run `npm run build`
7. Configure your web server (Apache/Nginx)

## 🛠️ Development Tips

### Running Multiple Commands
Keep these running in separate terminals during development:
```bash
# Terminal 1: Laravel dev server
php artisan serve

# Terminal 2: Vite dev server (for hot reload)
npm run dev
```

### Clearing Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [TailwindCSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev)

## 🆘 Support

If you encounter any issues:
1. Check the error logs in `storage/logs/laravel.log`
2. Verify all environment variables in `.env`
3. Ensure all dependencies are installed
4. Check PHP and database versions

## 🎉 Success!

Once everything is set up, you should see:
- A beautiful landing page at `http://127.0.0.1:8000`
- Login functionality working
- Dashboard with sliding sidebar
- All CRUD operations functional

Happy coding! 🚀
