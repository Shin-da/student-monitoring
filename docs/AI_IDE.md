# AI IDE Guide - Smart Student Monitoring System

Quick reference for AI assistants working on this project.

## 🏗 Architecture Overview

**MVC Framework**: Custom PHP MVC framework
**Entry Point**: `public/index.php` → `app/bootstrap.php` → `routes/web.php`
**Request Flow**: Router → Controller → Model (planned) → View

## 📁 Key Files & Structure

### Core Framework
- **Router**: `app/Core/Router.php` - URL routing and dispatch
- **Controller**: `app/Core/Controller.php` - Base controller class
- **View**: `app/Core/View.php` - Template rendering with layouts
- **Database**: `app/Core/Database.php` - PDO connection management
- **Session**: `app/Core/Session.php` - Session handling

### Controllers (app/Controllers/)
- `AuthController.php` - Authentication (login/logout/register)
- `AdminController.php` - Admin dashboard
- `TeacherController.php` - Teacher functionality
- `AdviserController.php` - Adviser dashboard
- `StudentController.php` - Student dashboard
- `ParentController.php` - Parent dashboard
- `HomeController.php` - Home page

### Helpers (app/Helpers/)
- `Validator.php` - Input validation (email, required, minLength)
- `Csrf.php` - CSRF token generation and validation (token(), check())
- `Response.php` - HTTP response utilities (json(), forbidden())

### Views (resources/views/)
- **Layouts**: `layouts/app.php` (main), `layouts/dashboard.php` (dashboard)
- **Auth**: `auth/login.php`, `auth/register.php`
- **Dashboards**: `admin/`, `teacher/`, `student/`, `parent/`, `adviser/`
- **Grades**: `grade/index.php` (management), `grade/student-view.php` (student/parent)
- **Students**: `student/index.php` (admin list)

## 🔧 Development Patterns

### Controller Pattern
```php
<?php
namespace Controllers;
use Core\Controller;

class ExampleController extends Controller
{
    public function action()
    {
        // Get data
        $data = ['title' => 'Page Title'];
        
        // Render view
        $this->view->render('view/path', $data, 'layouts/dashboard');
    }
}
```

### View Rendering
```php
$this->view->render('student/dashboard', [
    'title' => 'Student Dashboard',
    'data' => $data
], 'layouts/dashboard');
```

### Database Access
```php
$config = require BASE_PATH . '/config/config.php';
$db = Core\Database::connection($config['database']);
$stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch();
```

### Session Management
```php
Core\Session::set('user', $userData);
$user = Core\Session::get('user');
if (!$user) { header('Location: /login'); return; }
```

### Input Validation
```php
use Helpers\Validator;
if (!Validator::email($email)) { /* ... */ }
if (!Validator::required($name)) { /* ... */ }
```

### CSRF Protection
```php
use Helpers\Csrf;
<input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
if (!Csrf::check($_POST['csrf_token'] ?? '')) { /* ... */ }
```

## 🔐 Secure Auth Implementation

- Login/Register forms include CSRF tokens via `<?= Csrf::token() ?>`.
- `AuthController::login`
  - Validates CSRF, email/password
  - Fetches user by email; verifies with `password_verify`
  - Regenerates session ID on success; stores `{id, name, role}`
  - Redirects based on DB role (not user-input)
- `AuthController::register`
  - Validates CSRF, name/email/password (≥8 chars)
  - Ensures unique email; stores password with `password_hash`
  - Self-registration defaults to `role='student'`
- Logout (POST)
  - Requires CSRF token; destroys session
- Session security
  - Cookie flags configured in `config/config.php`; set `cookie_secure=true` in prod
  - Consider idle timeout and rolling expiration

## 🛣 Routing

```php
use Controllers\GradeController;
use Controllers\StudentController;
$router->get('/grade', [GradeController::class, 'index']);
$router->post('/grade', [GradeController::class, 'store']);
$router->get('/grade/student-view', [GradeController::class, 'studentView']);
$router->get('/students', [StudentController::class, 'index']);
$router->post('/students', [StudentController::class, 'store']);
$router->get('/students/{id}', [StudentController::class, 'show']);
```

## 🗄 Database Schema

See `docs/ERD_NOTES.md` and `database/schema.sql`.

## 🎞 Micro-interactions & Loading

- **Counters**: Add `data-count-to` (and optional `data-count-decimals`) to animate numbers.
- **Progress bars**: Add `data-progress-to="87.5"` to `.progress-bar` to animate width.
- **Skeletons**: Apply `skeleton` class to placeholders while data loads.
- **Entrance animations**: `.surface` and `.action-card` fade-in on scroll.

All are powered by `public/assets/app.js` and `public/assets/app.css`.

## 🔒 Security Conventions
- Escape output, use prepared statements, validate input, check sessions, include CSRF tokens.

## 📝 Code Conventions
- Namespaces and file organization match directory structure. Controllers: PascalCase; methods: camelCase.

## 🚨 Current Status
- Dashboards enhanced; grade and student UIs scaffolded; animations and loaders available.

---

See `docs/FRONTEND_UI.md` for deeper UI details and API contracts. 


