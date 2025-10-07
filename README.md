# Smart Student Monitoring System

A comprehensive web-based student monitoring system built with PHP, MySQL, and modern web technologies. This system provides role-based access control for administrators, teachers, advisers, students, and parents to monitor academic progress, attendance, and student performance.

## 📋 Table of Contents

- [Overview](#overview)
- [Tech Stack](#tech-stack)
- [System Architecture](#system-architecture)
- [Installation & Setup](#installation--setup)
- [Project Structure](#project-structure)
- [MVC Pattern Explanation](#mvc-pattern-explanation)
- [Database Schema](#database-schema)
- [API Endpoints & Routes](#api-endpoints--routes)
- [Development Workflow](#development-workflow)
- [Backend Development Guide](#backend-development-guide)
- [Security Considerations](#security-considerations)
- [Testing](#testing)
- [Deployment](#deployment)
- [Contributing](#contributing)

## 🎯 Overview

The Smart Student Monitoring System is designed to streamline educational management by providing:

- **Role-based Access Control**: Different dashboards for Admin, Teacher, Adviser, Student, and Parent roles
- **Student Progress Tracking**: Monitor grades, attendance, and academic performance
- **Real-time Alerts**: Notifications for teachers and parents about student performance
- **Comprehensive Reporting**: Analytics and reports for academic insights
- **Modern Web Interface**: Responsive design with Bootstrap 5

## 🛠 Tech Stack

### Backend
- **PHP 8.x** - Server-side programming language
- **MySQL 8.x** - Database management system
- **Apache** - Web server (via XAMPP)

### Frontend
- **HTML5** - Markup language
- **CSS3** - Styling
- **Bootstrap 5** - CSS framework for responsive design
- **jQuery** - JavaScript library for DOM manipulation

### Development Environment
- **XAMPP** - Local development environment
- **Composer** - Dependency management (if needed)

## 🏗 System Architecture

The system follows the **Model-View-Controller (MVC)** architectural pattern:

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│     Browser     │◄──►│   Controller    │◄──►│     Model       │
│   (Frontend)    │    │   (Logic)       │    │   (Database)    │
└─────────────────┘    └─────────────────┘    └─────────────────┘
                              │
                              ▼
                       ┌─────────────────┐
                       │      View       │
                       │   (Templates)   │
                       └─────────────────┘
```

### Request Flow
1. **User Request** → Browser sends HTTP request
2. **Router** → Routes request to appropriate controller
3. **Controller** → Processes business logic
4. **Model** → Interacts with database (when implemented)
5. **View** → Renders HTML response
6. **Response** → Sends HTML back to browser

## 🚀 Installation & Setup

### Prerequisites
- XAMPP (Apache + MySQL + PHP 8.x)
- Web browser
- Code editor (VS Code recommended)

### Step-by-Step Setup

1. **Clone/Download the Project**
   ```bash
   # Place the project in your XAMPP htdocs directory
   C:\xampp\htdocs\web-based student monitoring\
   ```

2. **Database Setup**
   ```sql
   -- Open phpMyAdmin (http://localhost/phpmyadmin)
   -- Create a new database named 'student_monitoring'
   -- Import the schema from database/schema.sql
   ```

3. **Configuration**
   ```php
   // Edit config/config.php if needed
   // Default settings should work with XAMPP
   'database' => [
       'host' => '127.0.0.1',
       'port' => 3306,
       'database' => 'student_monitoring',
       'username' => 'root',
       'password' => '', // Empty for XAMPP default
   ]
   ```

4. **Apache Configuration**
   - Ensure `mod_rewrite` is enabled in Apache
   - Point your virtual host to the `public/` directory
   - Or access via: `http://localhost/web-based%20student%20monitoring/public/`

5. **Test Installation**
   - Visit: `http://localhost/web-based%20student%20monitoring/public/`
   - You should see the home page
   - Try: `/login` for authentication

## 📁 Project Structure

```
web-based student monitoring/
├── app/                          # Application core
│   ├── Controllers/              # MVC Controllers
│   │   ├── AdminController.php   # Admin dashboard logic
│   │   ├── AdviserController.php # Adviser functionality
│   │   ├── AuthController.php    # Authentication logic
│   │   ├── HomeController.php    # Home page logic
│   │   ├── ParentController.php  # Parent dashboard
│   │   ├── StudentController.php # Student dashboard
│   │   └── TeacherController.php # Teacher functionality
│   ├── Core/                     # Core framework classes
│   │   ├── Controller.php        # Base controller class
│   │   ├── Database.php          # Database connection
│   │   ├── Router.php            # URL routing
│   │   ├── Session.php           # Session management
│   │   └── View.php              # View rendering
│   └── Helpers/                  # Utility classes
│       ├── Csrf.php              # CSRF protection (token(), check())
│       ├── Response.php          # HTTP responses (json(), forbidden())
│       └── Validator.php         # Input validation (email(), required(), minLength())
├── config/                       # Configuration files
│   └── config.php                # Main configuration
├── database/                     # Database files
│   └── schema.sql                # Database schema
├── docs/                         # Documentation
│   ├── AI_IDE.md                 # AI assistant guide
│   ├── ERD_NOTES.md              # Database design notes
│   └── README.md                 # This file
├── public/                       # Web-accessible files
│   ├── assets/                   # CSS, JS, images
│   │   ├── app.css               # Main stylesheet
│   │   ├── app.js                # Main JavaScript
│   │   └── favicon.svg           # Site icon
│   └── index.php                 # Entry point
├── resources/                    # Views and templates
│   └── views/                    # PHP view templates
│       ├── admin/                # Admin views
│       ├── adviser/              # Adviser views
│       ├── auth/                 # Authentication views
│       ├── home/                 # Home page views
│       ├── layouts/              # Layout templates
│       ├── parent/               # Parent views
│       ├── student/              # Student views
│       └── teacher/              # Teacher views
├── routes/                       # Route definitions
│   └── web.php                   # Web routes
├── app/                          # Application bootstrap
│   └── bootstrap.php             # Application initialization
└── index.php                     # Main entry point
```

## 🎨 MVC Pattern Explanation

### What is MVC?

**MVC (Model-View-Controller)** is a design pattern that separates an application into three interconnected components:

### 1. Model (Data Layer)
- **Purpose**: Handles data and business logic
- **Responsibilities**:
  - Database operations (CRUD)
  - Data validation
  - Business rules
  - Data relationships

**Example Model Structure** (to be implemented):
```php
<?php
namespace Models;

class Student extends Model
{
    protected $table = 'students';
    
    public function getGrades($studentId)
    {
        // Fetch student grades from database
    }
    
    public function getAttendance($studentId)
    {
        // Fetch attendance records
    }
}
```

### 2. View (Presentation Layer)
- **Purpose**: Handles user interface and presentation
- **Responsibilities**:
  - Display data to users
  - Handle user input forms
  - Template rendering
  - HTML/CSS/JavaScript

**Example View** (`resources/views/student/dashboard.php`):
```php
<div class="container">
    <h1>Student Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <h3>Recent Grades</h3>
            <?php foreach ($grades as $grade): ?>
                <p><?= htmlspecialchars($grade['subject']) ?>: <?= $grade['score'] ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
```

### 3. Controller (Logic Layer)
- **Purpose**: Handles user input and coordinates between Model and View
- **Responsibilities**:
  - Process HTTP requests
  - Validate input
  - Call appropriate Model methods
  - Render appropriate Views
  - Handle redirects

**Example Controller** (`app/Controllers/StudentController.php`):
```php
<?php
namespace Controllers;

use Core\Controller;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Get student data from session
        $studentId = Session::get('user.id');
        
        // Fetch data (when Models are implemented)
        // $student = new Student();
        // $grades = $student->getGrades($studentId);
        
        // For now, use placeholder data
        $grades = [
            ['subject' => 'Math', 'score' => 85],
            ['subject' => 'Science', 'score' => 92]
        ];
        
        // Render view with data
        $this->view->render('student/dashboard', [
            'title' => 'Student Dashboard',
            'grades' => $grades
        ]);
    }
}
```

### MVC Flow in This Project

1. **Request**: User visits `/student`
2. **Router**: Routes to `StudentController::dashboard()`
3. **Controller**: Processes request, fetches data
4. **View**: Renders `student/dashboard.php` with data
5. **Response**: HTML sent to browser

## 🗄 Database Schema

### Current Tables (Phase 1)

#### Users Table
```sql
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role ENUM('admin','teacher','adviser','student','parent') NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(191) NOT NULL,
    status ENUM('pending','active','suspended') DEFAULT 'pending',
    requested_role ENUM('admin','teacher','adviser','student','parent') NULL,
    approved_by INT UNSIGNED NULL,
    approved_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (approved_by) REFERENCES users(id)
);
```

#### Students Table
```sql
CREATE TABLE students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    lrn VARCHAR(20) UNIQUE,
    grade_level TINYINT UNSIGNED,
    section_id INT UNSIGNED NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

#### Teachers Table
```sql
CREATE TABLE teachers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    is_adviser TINYINT(1) DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

#### Parents Table
```sql
CREATE TABLE parents (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    student_id INT UNSIGNED NULL,
    relationship ENUM('father','mother','guardian') DEFAULT 'guardian',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (student_id) REFERENCES students(id)
);
```

#### Additional Tables
- `subjects` - Subject definitions with grade weights
- `sections` - Class sections with advisers
- `enrollments` - Student-section relationships

### Planned Tables (Phase 2+)
- `grades` - Student grades and assessments
- `grade_items` - Individual grade components
- `quarterly_grades` - Quarterly grade summaries
- `attendance` - Student attendance records
- `alerts` - System notifications
- `audit_logs` - System activity logs

## 🛣 API Endpoints & Routes

### Current Routes (`routes/web.php`)

#### Public Routes
```php
GET  /                    # Home page
GET  /login              # Login form
POST /login              # Process login
GET  /register           # Registration form
POST /register           # Process registration
POST /logout             # Logout user
```

#### Protected Routes (Role-based)
```php
# Admin Routes
GET  /admin                    # Admin dashboard
GET  /admin/users              # User management
GET  /admin/create-user        # Create user form
POST /admin/create-user        # Process user creation
GET  /admin/create-parent      # Create parent form
POST /admin/create-parent      # Process parent creation
POST /admin/approve-user       # Approve pending user
POST /admin/reject-user        # Reject pending user
POST /admin/suspend-user       # Suspend user
POST /admin/activate-user      # Activate user

# Role Dashboards
GET  /teacher                  # Teacher dashboard
GET  /teacher/alerts           # Teacher alerts
GET  /adviser                  # Adviser dashboard
GET  /student                  # Student dashboard
GET  /parent                   # Parent dashboard
```

### Adding New Routes

1. **Define Route** in `routes/web.php`:
```php
$router->get('/students', [StudentController::class, 'index']);
$router->post('/students', [StudentController::class, 'store']);
$router->get('/students/{id}', [StudentController::class, 'show']);
```

2. **Create Controller Method**:
```php
public function index()
{
    // Fetch all students
    $students = []; // Will be replaced with actual Model calls
    
    $this->view->render('student/index', [
        'title' => 'Students',
        'students' => $students
    ]);
}
```

3. **Create View** (`resources/views/student/index.php`):
```php
<div class="container">
    <h1>Students</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Grade Level</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= $student['grade_level'] ?></td>
                    <td><?= htmlspecialchars($student['section']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
```

## 🔧 Development Workflow

### 1. Setting Up Development Environment

```bash
# Start XAMPP services
# - Apache
# - MySQL

# Access phpMyAdmin
http://localhost/phpmyadmin

# Access application
http://localhost/web-based%20student%20monitoring/public/
```

### 2. Development Process

1. **Plan Feature**: Define requirements and database changes
2. **Update Database**: Modify schema if needed
3. **Create Model**: Implement data layer
4. **Create Controller**: Implement business logic
5. **Create View**: Implement user interface
6. **Add Routes**: Define URL mappings
7. **Test**: Verify functionality
8. **Document**: Update documentation

### 3. Code Organization

#### Controllers
- One controller per major feature
- Methods correspond to actions
- Keep controllers thin (delegate to Models)

#### Models (To be implemented)
- One model per database table
- Handle all database operations
- Implement business logic

#### Views
- Organized by feature/role
- Use layouts for common structure
- Escape all output with `htmlspecialchars()`

## 👨‍💻 Backend Development Guide

### For Backend Developers New to MVC

#### Understanding the Framework

This project uses a **custom MVC framework** built from scratch. Here's what you need to know:

1. **Entry Point**: All requests start at `public/index.php`
2. **Bootstrap**: `app/bootstrap.php` initializes the application
3. **Routing**: `routes/web.php` defines URL patterns
4. **Controllers**: Handle business logic in `app/Controllers/`
5. **Views**: Templates in `resources/views/`
6. **Models**: Data layer (to be implemented in `app/Models/`)

#### Step-by-Step Development

##### 1. Creating a New Feature

**Example: Student Grade Management**

1. **Plan the Feature**:
   - What data do we need?
   - What actions are required?
   - What views are needed?

2. **Database Design**:
```sql
-- Add to schema.sql
CREATE TABLE grades (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    subject_id INT UNSIGNED NOT NULL,
    grade_value DECIMAL(5,2) NOT NULL,
    grade_type ENUM('ww','pt','qe') NOT NULL,
    quarter TINYINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);
```

3. **Create Model** (`app/Models/Grade.php`):
```php
<?php
declare(strict_types=1);

namespace Models;

use Core\Database;

class Grade
{
    private $db;
    
    public function __construct()
    {
        $config = require BASE_PATH . '/config/config.php';
        $this->db = Database::connection($config['database']);
    }
    
    public function create(array $data): bool
    {
        $sql = "INSERT INTO grades (student_id, subject_id, grade_value, grade_type, quarter) 
                VALUES (:student_id, :subject_id, :grade_value, :grade_type, :quarter)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function getByStudent(int $studentId): array
    {
        $sql = "SELECT g.*, s.name as subject_name 
                FROM grades g 
                JOIN subjects s ON g.subject_id = s.id 
                WHERE g.student_id = :student_id 
                ORDER BY g.quarter, s.name";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['student_id' => $studentId]);
        return $stmt->fetchAll();
    }
}
```

4. **Create Controller** (`app/Controllers/GradeController.php`):
```php
<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Models\Grade;
use Helpers\Validator;

class GradeController extends Controller
{
    public function index()
    {
        // Check if user is logged in and has permission
        $user = Session::get('user');
        if (!$user) {
            header('Location: /login');
            return;
        }
        
        $gradeModel = new Grade();
        $grades = [];
        
        // Get grades based on user role
        if ($user['role'] === 'student') {
            $grades = $gradeModel->getByStudent($user['id']);
        }
        // Add other role logic here
        
        $this->view->render('grade/index', [
            'title' => 'Grades',
            'grades' => $grades
        ]);
    }
    
    public function store()
    {
        // Validate CSRF token
        if (!Csrf::check($_POST['csrf_token'] ?? '')) {
            header('Location: /grade');
            return;
        }
        
        // Validate input
        $data = [
            'student_id' => (int)($_POST['student_id'] ?? 0),
            'subject_id' => (int)($_POST['subject_id'] ?? 0),
            'grade_value' => (float)($_POST['grade_value'] ?? 0),
            'grade_type' => $_POST['grade_type'] ?? '',
            'quarter' => (int)($_POST['quarter'] ?? 1)
        ];
        
        // Validate required fields
        if (!Validator::required($data['student_id']) || 
            !Validator::required($data['subject_id']) ||
            !Validator::required($data['grade_value'])) {
            // Handle validation error
            header('Location: /grade?error=validation');
            return;
        }
        
        $gradeModel = new Grade();
        if ($gradeModel->create($data)) {
            header('Location: /grade?success=created');
        } else {
            header('Location: /grade?error=database');
        }
    }
}
```

5. **Create View** (`resources/views/grade/index.php`):
```php
<div class="container">
    <h1>Grades</h1>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Grade added successfully!</div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Error: <?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Grade Type</th>
                        <th>Quarter</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grades as $grade): ?>
                        <tr>
                            <td><?= htmlspecialchars($grade['subject_name']) ?></td>
                            <td><?= strtoupper($grade['grade_type']) ?></td>
                            <td><?= $grade['quarter'] ?></td>
                            <td><?= $grade['grade_value'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="col-md-4">
            <h3>Add New Grade</h3>
            <form method="POST" action="/grade">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                
                <div class="mb-3">
                    <label class="form-label">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select Student</option>
                        <!-- Populate with actual students -->
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <select name="subject_id" class="form-select" required>
                        <option value="">Select Subject</option>
                        <!-- Populate with actual subjects -->
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Grade Type</label>
                    <select name="grade_type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="ww">Written Work</option>
                        <option value="pt">Performance Task</option>
                        <option value="qe">Quarterly Exam</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Grade Value</label>
                    <input type="number" name="grade_value" class="form-control" 
                           min="0" max="100" step="0.01" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Quarter</label>
                    <select name="quarter" class="form-select" required>
                        <option value="1">1st Quarter</option>
                        <option value="2">2nd Quarter</option>
                        <option value="3">3rd Quarter</option>
                        <option value="4">4th Quarter</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Add Grade</button>
            </form>
        </div>
    </div>
</div>
```

6. **Add Routes** (`routes/web.php`):
```php
// Add these routes
$router->get('/grade', [GradeController::class, 'index']);
$router->post('/grade', [GradeController::class, 'store']);
```

#### Key Development Principles

1. **Security First**:
   - Always validate input
   - Use prepared statements
   - Escape output in views
   - Implement CSRF protection

2. **Error Handling**:
   - Handle database errors gracefully
   - Provide user-friendly error messages
   - Log errors for debugging

3. **Code Organization**:
   - Keep controllers thin
   - Put business logic in models
   - Use consistent naming conventions
   - Follow PSR-4 autoloading

4. **Database Best Practices**:
   - Use prepared statements
   - Implement proper indexing
   - Use transactions for complex operations
   - Validate data before database operations

### Common Patterns

#### Authentication Check
```php
public function someAction()
{
    $user = Session::get('user');
    if (!$user) {
        header('Location: /login');
        return;
    }
    
    // Check specific role if needed
    if ($user['role'] !== 'admin') {
        header('Location: /unauthorized');
        return;
    }
    
    // Continue with action
}
```

#### Form Processing
```php
public function processForm()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /form');
        return;
    }
    
    // Validate CSRF
    if (!Csrf::check($_POST['csrf_token'] ?? '')) {
        header('Location: /form?error=csrf');
        return;
    }
    
    // Validate and sanitize input
    $data = $this->validateInput($_POST);
    
    if ($data === false) {
        header('Location: /form?error=validation');
        return;
    }
    
    // Process data
    $result = $this->model->create($data);
    
    if ($result) {
        header('Location: /success');
    } else {
        header('Location: /form?error=database');
    }
}
```

#### Database Operations
```php
// In Model class
public function find(int $id): ?array
{
    $sql = "SELECT * FROM table_name WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    
    $result = $stmt->fetch();
    return $result ?: null;
}

public function create(array $data): bool
{
    $sql = "INSERT INTO table_name (column1, column2) VALUES (:value1, :value2)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
}
```

## 🔒 Security Considerations

### Current Security Features

1. **CSRF Protection**: Implemented in `Helpers\Csrf`
2. **Session Management**: Secure session handling
3. **Input Validation**: Basic validation helpers
4. **SQL Injection Prevention**: Prepared statements (when implemented)

### Security Best Practices

1. **Always Validate Input**:
```php
// Validate email
if (!Validator::email($email)) {
    // Handle error
}

// Validate required fields
if (!Validator::required($name)) {
    // Handle error
}
```

2. **Escape Output**:
```php
// In views, always escape output
<?= htmlspecialchars($user['name']) ?>
```

3. **Use Prepared Statements**:
```php
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $db->prepare($sql);
$stmt->execute(['email' => $email]);
```

4. **Implement Proper Authentication**:
```php
// Check if user is logged in
$user = Session::get('user');
if (!$user) {
    header('Location: /login');
    return;
}
```

### Security Checklist

- [ ] All forms have CSRF tokens
- [ ] All input is validated
- [ ] All output is escaped
- [ ] Database queries use prepared statements
- [ ] Authentication is checked on protected routes
- [ ] Role-based access control is implemented
- [ ] Passwords are properly hashed
- [ ] Session security is configured

## 🧪 Testing

### Manual Testing Checklist

1. **Authentication**:
   - [ ] Login with valid credentials
   - [ ] Login with invalid credentials
   - [ ] Logout functionality
   - [ ] Session persistence

2. **Authorization**:
   - [ ] Role-based access control
   - [ ] Unauthorized access attempts
   - [ ] Protected route access

3. **Forms**:
   - [ ] Form validation
   - [ ] CSRF protection
   - [ ] Data submission
   - [ ] Error handling

4. **Database**:
   - [ ] Data creation
   - [ ] Data retrieval
   - [ ] Data updates
   - [ ] Data deletion

### Testing Tools

- **Browser Developer Tools**: For debugging frontend
- **phpMyAdmin**: For database inspection
- **XAMPP Error Logs**: For server-side debugging

## 🚀 Deployment

### Production Checklist

1. **Configuration**:
   - [ ] Update `config/config.php` for production
   - [ ] Set `display_errors` to false
   - [ ] Configure proper database credentials
   - [ ] Set secure session options

2. **Security**:
   - [ ] Enable HTTPS
   - [ ] Configure secure cookies
   - [ ] Set proper file permissions
   - [ ] Remove development files

3. **Performance**:
   - [ ] Enable Apache compression
   - [ ] Configure caching headers
   - [ ] Optimize database queries
   - [ ] Minify CSS/JS files

### Production Configuration Example

```php
// config/config.php for production
return [
    'app' => [
        'name' => 'Smart Student Monitoring',
        'env' => 'production',
        'base_url' => 'https://yourdomain.com/',
        'timezone' => 'Asia/Manila',
        'display_errors' => false, // Important for production
    ],
    'database' => [
        'driver' => 'mysql',
        'host' => 'your-production-host',
        'port' => 3306,
        'database' => 'student_monitoring_prod',
        'username' => 'your-username',
        'password' => 'your-secure-password',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
    ],
    'session' => [
        'name' => 'ssm_session',
        'cookie_lifetime' => 60 * 60 * 8, // 8 hours
        'cookie_secure' => true, // HTTPS only
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict',
    ],
];
```

## 🤝 Contributing

### Development Guidelines

1. **Code Style**:
   - Follow PSR-12 coding standards
   - Use meaningful variable and function names
   - Add comments for complex logic
   - Keep functions small and focused

2. **Git Workflow**:
   ```bash
   # Create feature branch
   git checkout -b feature/new-feature
   
   # Make changes and commit
   git add .
   git commit -m "Add new feature"
   
   # Push and create pull request
   git push origin feature/new-feature
   ```

3. **Documentation**:
   - Update README for new features
   - Document API changes
   - Add inline comments for complex code
   - Update database schema documentation

### Pull Request Process

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Update documentation
6. Submit pull request with description

## 📞 Support

### Getting Help

1. **Check Documentation**: Review this README and other docs
2. **Check Issues**: Look for similar problems in GitHub issues
3. **Ask Questions**: Create an issue with detailed description
4. **Code Review**: Request code review for complex changes

### Common Issues

1. **Database Connection Error**:
   - Check XAMPP MySQL is running
   - Verify database credentials in config
   - Ensure database exists

2. **404 Errors**:
   - Check Apache mod_rewrite is enabled
   - Verify .htaccess file exists in public/
   - Check route definitions

3. **Session Issues**:
   - Check session configuration
   - Verify session directory permissions
   - Clear browser cookies

---

## 📝 Notes for Backend Developers

### Current Status (Phase 1)

This is a **foundation/scaffold** project. The following components are **implemented**:

✅ **Completed**:
- MVC framework structure
- Routing system
- Session management
- **Complete authentication system with role-based access**
- **Admin user management with approval workflow**
- **Student self-registration with admin approval**
- **Teacher/Parent account creation by admin**
- Database connection with user management schema
- View rendering system
- CSRF protection
- Input validation helpers
- Basic UI with Bootstrap 5

🔄 **To Be Implemented** (Phase 2+):
- Grade management system
- Attendance tracking
- Student-teacher assignments
- Parent-student linking
- Alert/notification system
- Reporting and analytics
- File upload handling
- Email notifications
- Advanced security features

### Next Steps for Backend Development

1. **Create Core Models**:
   - Student model
   - Teacher model
   - Grade model
   - Attendance model

2. **Implement CRUD Operations**:
   - Student management
   - Grade entry and management
   - Attendance tracking
   - Subject and section management

3. **Add Advanced Features**:
   - File uploads
   - Email notifications
   - Reporting system
   - Audit logging

### Development Priority

1. **High Priority**:
   - Implement core models
   - Basic CRUD operations
   - Grade calculation system

2. **Medium Priority**:
   - Attendance tracking
   - Basic reporting
   - Student-teacher assignments

3. **Low Priority**:
   - Advanced analytics
   - Email notifications
   - File management

---

**Happy Coding! 🚀**

This documentation should provide everything a backend developer needs to understand and contribute to the Smart Student Monitoring System. Remember to follow the MVC pattern, implement proper security measures, and test thoroughly before deploying to production.

## 🧩 Frontend UI Scaffolding (New)

We added production-ready UI scaffolding to accelerate backend integration:

- Grade Management UI: `resources/views/grade/index.php`
- Student Management UI: `resources/views/student/index.php`
- Student Grade View: `resources/views/grade/student-view.php`
- Enhanced Dashboards: `resources/views/teacher/dashboard.php`, `resources/views/student/dashboard.php`
- Micro-interactions: animated counters (`data-count-to`), progress bar animations (`data-progress-to`), skeleton loaders (`.skeleton`), and scroll entrance for cards.

See `docs/FRONTEND_UI.md` for:
- Views and components breakdown
- Expected API contracts for Grades and Students
- Suggested routes and controller wiring
- Validation behavior and print styles
- Micro-interactions and loading patterns

Recommended backend routes to enable these UIs (server-rendered):
```php
$router->get('/grade', [Controllers\\GradeController::class, 'index']);
$router->post('/grade', [Controllers\\GradeController::class, 'store']);
$router->get('/grade/student-view', [Controllers\\GradeController::class, 'studentView']);

$router->get('/students', [Controllers\\StudentController::class, 'index']);
$router->post('/students', [Controllers\\StudentController::class, 'store']);
$router->get('/students/{id}', [Controllers\\StudentController::class, 'show']);
```

## 🔐 Authentication (Implemented)

- CSRF-protected forms for Login/Register/Logout
- Registration: validates inputs, hashes passwords with `password_hash`, defaults role to `student`
- Login: validates credentials, verifies with `password_verify`, regenerates session ID, redirects by stored DB role
- Logout: POST-only with CSRF, destroys session
- Session cookies configured in `config/config.php` (enable `cookie_secure` in production)

### Seeding an Admin User

**Option 1: Use the provided script (Recommended)**
```bash
php database/init_admin.php
```

**Option 2: Manual SQL**
Run this SQL in your database to create an initial admin:
```sql
INSERT INTO users (role, email, password_hash, name, status, approved_by, approved_at)
VALUES ('admin', 'admin@example.com', '$2y$10$...', 'Administrator', 'active', NULL, NOW());
```
Note: Replace `$2y$10$...` with a PHP-generated hash:
```php
<?php echo password_hash('ChangeMe123!', PASSWORD_DEFAULT); ?>
```
