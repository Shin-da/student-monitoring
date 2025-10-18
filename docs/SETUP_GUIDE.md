# Quick Setup Guide

## 🚀 Getting Started (5 Minutes)

### Prerequisites
- XAMPP installed and running
- Web browser

### Step 1: Database Setup
1. **Start XAMPP** (Apache + MySQL)
2. **Open phpMyAdmin**: http://localhost/phpmyadmin
3. **Create Database**: `student_monitoring`
4. **Import Schema**: Run `database/schema.sql`

### Step 2: Update Database
```powershell
# Navigate to project directory
cd "C:\xampp\htdocs\student-monitoring"

# Update database with user management features
php database/update_schema.php
```

### Step 3: Create Admin User
```bash
# Create initial admin user
php database/init_admin.php
```

### Step 4: Access Application
- **URL**: http://localhost/student-monitoring/public/
- If accessing from `http://localhost/student-monitoring/`, ensure `.htaccess` exists in project root:
```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /student-monitoring/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ public/index.php [L]
</IfModule>
```
- **Admin Login**: admin@example.com / admin123
- **⚠️ Change admin password immediately!**

### PWA Notes
- You can install the app to your device when prompted.
- If you pull updates, hard reload twice to activate the new Service Worker.

## 🧪 Testing the System

### 1. Test Student Registration
1. Go to `/register`
2. Fill out student registration form
3. Submit - should see "pending approval" message
4. Student cannot log in yet

### 2. Test Admin Approval
1. Login as admin
2. Go to `/admin/users`
3. See pending student in the list
4. Click green checkmark to approve
5. Student can now log in

### 3. Test User Management
1. In admin dashboard, click "Create New User"
2. Create a teacher account
3. Teacher can log in immediately (no approval needed)

### 4. Test Parent Creation
1. In admin dashboard, click "Create Parent Account"
2. Link parent to a student
3. Parent can log in and see only their child's info

## 🔧 Troubleshooting

### Database Connection Error
- Check XAMPP MySQL is running
- Verify database name is `student_monitoring`
- Check credentials in `config/config.php`

### CSRF Token Errors
- Use incognito/private browser window
- Clear browser cache and cookies
- Refresh the page

### 404 Errors
- Check Apache mod_rewrite is enabled
- Verify `.htaccess` file exists in `public/` directory
- Access via: `http://localhost/student-monitoring/public/` or enable root `.htaccess` redirect as above

### Error Pages Not Showing
- Ensure error routes exist in `routes/web.php`
- Verify `app/Core/Router.php` redirects unknown routes to `/error/404`
- Controllers should use `Helpers\ErrorHandler` for 401/403 redirections

### Permission Errors
- Check file permissions on project directory
- Ensure Apache can read all files
- Check XAMPP error logs

## 📋 Default Credentials

### Admin Account
- **Email**: admin@example.com
- **Password**: admin123
- **⚠️ Change immediately after first login!**

### Test Student (if created)
- **Email**: student@example.com
- **Password**: (whatever you set during registration)

## 🎯 Next Steps

1. **Change admin password**
2. **Create teacher accounts**
3. **Create parent accounts linked to students**
4. **Test all user management functions**
5. **Start building grade management system**

## 📚 Documentation

- **User Management**: [USER_MANAGEMENT.md](USER_MANAGEMENT.md)
- **Main Guide**: [README.md](../README.md)
- **Frontend UI**: [FRONTEND_UI.md](FRONTEND_UI.md)
- **Database Design**: [ERD_NOTES.md](ERD_NOTES.md)

---

**Need Help?** Check the main [README.md](../README.md) for detailed documentation and troubleshooting guides.

## 🧩 PWA Troubleshooting

	- `resources/views/layouts/app.php` contains `window.__BASE_PATH__` and manifest link uses `Url::publicPath('manifest.json')`.
	- `public/assets/pwa-manager.js` registers the service worker using `window.__BASE_PATH__`.
	- `public/sw.js` prefixes cached URLs using its `self.registration.scope`.

### 📦 Base-Path Awareness & Helper Usage
All asset and navigation URLs now use helper functions (`Url::to`, `Url::asset`, `Url::publicPath`) for full base-path awareness.
The system works seamlessly when deployed in a subfolder (e.g., `/student-monitoring`).
Service Worker, manifest, and offline page are base-path aware and portable.
All documentation and troubleshooting guides have been updated to reflect these changes.
