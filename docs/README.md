# Smart Student Monitoring System - Quick Reference

> **📖 For comprehensive documentation, see the main [README.md](../README.md)**

## 🚀 Quick Start

This is a web-based student monitoring system built with PHP MVC architecture.
### 📦 Base-Path Awareness & Helper Usage
All asset and navigation URLs now use helper functions (`Url::to`, `Url::asset`, `Url::publicPath`) for full base-path awareness.
The system works seamlessly when deployed in a subfolder (e.g., `/student-monitoring`).
Service Worker, manifest, and offline page are base-path aware and portable.
Troubleshooting and setup guides updated to reflect these changes.

### ❗ Error Pages & Routing
- Unified error pages (401/403/404/500/503) via `ErrorController`
- Use `Helpers\\ErrorHandler` in controllers instead of `Response::forbidden()`
- XAMPP users: ensure the root `.htaccess` redirects to `public/index.php` for clean URLs

### Prerequisites
- XAMPP (Apache + MySQL + PHP 8.x)
- Web browser

### Setup (5 minutes)
1. **Database**: Create `student_monitoring` database in MySQL
2. **Import Schema**: Run `database/schema.sql` in phpMyAdmin
3. **Update Schema**: Run `php database/update_schema.php` to add user management features
4. **Create Admin**: Run `php database/init_admin.php` to create initial admin user
5. **Access**: Visit `http://localhost/student-monitoring/public/`
6. **Login**: Use admin@example.com / admin123 (change password immediately!)

## PWA behavior and offline support

- The application supports installation as a Progressive Web App.
- Works when hosted under a subfolder (e.g., `/student-monitoring`): the Service Worker and manifest use relative scope and start_url.
- `offline.html` is pre-cached and used for offline fallback.
- After updates, perform a hard reload twice to ensure the Service Worker activates.

### Current Status (Phase 1)
✅ **Completed**:
- MVC framework structure
- Routing system
- Session management
- **Complete authentication system with role-based access**
- **Admin user management with approval workflow**
- **Student self-registration with admin approval**
- **Teacher/Parent account creation by admin**
- Database connection with user management schema
- View rendering with Bootstrap 5
- CSRF protection
- Input validation helpers
- Frontend UI scaffolding for Grades and Students

🔄 **Next Phase**:
- Grade management system
- Attendance tracking
- Student-teacher assignments
- Parent-student linking
- Reporting system

### Tech Stack
- **Backend**: PHP 8.x, MySQL 8.x, Apache
- **Frontend**: HTML5, CSS3, Bootstrap 5, jQuery
- **Architecture**: Custom MVC Framework

### Project Structure
```
├── app/                    # Application core
│   ├── Controllers/        # MVC Controllers
│   ├── Core/              # Framework classes
│   └── Helpers/           # Utility classes
├── config/                # Configuration
├── database/              # Database schema
├── public/                # Web-accessible files
├── resources/views/       # PHP templates
├── routes/                # URL routing
└── docs/                  # Documentation
```

### Key Files
- **Entry Point**: `public/index.php`
- **Configuration**: `config/config.php`
- **Routes**: `routes/web.php`
- **Database**: `database/schema.sql`

### Quick Commands
```bash
# Start XAMPP services
# Access application
http://localhost/student-monitoring/public/

# Access phpMyAdmin
http://localhost/phpmyadmin
```

### Documentation
- **Quick Setup**: [SETUP_GUIDE.md](SETUP_GUIDE.md) - 5-minute setup guide
- **User Management**: [USER_MANAGEMENT.md](USER_MANAGEMENT.md) - Complete user management system guide
- **Main Guide**: [README.md](../README.md) - Comprehensive developer documentation
- **Frontend UI**: [FRONTEND_UI.md](FRONTEND_UI.md) - Views, components, and API contracts
- **AI Reference**: [AI_IDE.md](AI_IDE.md) - Quick reference for AI assistants
- **Database Design**: [ERD_NOTES.md](ERD_NOTES.md) - Database relationships

---

**Need help?** Check the main [README.md](../README.md) for detailed setup, development guides, and examples.


