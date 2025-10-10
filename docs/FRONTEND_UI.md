# Frontend UI Guide - Smart Student Monitoring System

This document describes the current frontend UI scaffolding, views, components, and expected backend integration points. It serves both frontend and backend developers to align on data contracts.

## Overview

The UI is built with Bootstrap 5 and custom CSS (`public/assets/app.css`). All dashboards share `resources/views/layouts/dashboard.php`. Public pages use `resources/views/layouts/app.php`.

Dark/Light theme support and responsive layout are included by default.

## Recent Enhancements

### Complete Sidebar System
- **Files**: `public/assets/sidebar-complete.css`, `public/assets/sidebar-complete.js`
- **Features**: 
  - Fixed positioning with proper content margin
  - Mobile responsive with toggle and overlay
  - State persistence using localStorage
  - Accessibility compliant with ARIA attributes
  - Keyboard navigation support
  - Smooth animations and transitions
  - Collapsible navigation sections
  - Optional accordion behavior (one open section at a time) when the sidebar has `data-accordion="true"` (enabled by default in `resources/views/layouts/dashboard.php`)

> Note: Legacy admin sidebar assets (`public/assets/admin-sidebar.js`, `public/assets/admin-sidebar.css`) were removed as unused to avoid conflicts with the complete sidebar system. Always include `sidebar-complete.js` in dashboard layouts.

### Chart System Fixes
- **Files**: `public/assets/chart-fixes.css`, enhanced chart JS files
- **Features**:
  - Height constraints to prevent infinite growth
  - Responsive behavior for all screen sizes
  - Error handling for chart initialization conflicts
  - Performance monitoring with automatic cleanup

### Enhanced Admin Interface
- **Files**: Multiple admin pages and components
- **Features**:
  - Advanced filtering and search for user management
  - Bulk actions and role-specific forms
  - Enterprise-level analytics dashboard
  - Comprehensive settings and reports pages
  - Real-time system monitoring

### Complete Student Interface
- **Files**: Multiple student pages and components
- **Features**:
  - Comprehensive student dashboard with statistics and charts
  - Interactive grades page with filtering and export
  - Assignment management with timeline and calendar views
  - Profile management with academic performance tracking
  - Organized sidebar navigation with collapsible sections
  - Real-time updates and responsive design

### Complete Teacher Interface
- **Files**: Multiple teacher pages and components
- **Features**:
  - Comprehensive teacher dashboard with statistics and class overview
  - Interactive grade management with bulk operations and charts
  - Class management with student lists, schedules, and activities
  - Assignment creation and management with due dates and submission tracking
  - Student progress tracking with individual performance reports
  - Attendance management with calendar view and bulk recording
  - Communication and messaging system for students and parents
  - Teaching materials and resource sharing
  - Organized sidebar navigation with collapsible sections
  - Real-time updates and responsive design

### Complete Adviser Interface
- **Files**: Multiple adviser pages and components
- **Features**:
  - Enhanced Adviser Dashboard with statistics, charts, and quick actions
  - Student Management with filtering, search, and bulk operations
  - Performance Tracking with analytics and intervention management
  - Communication Center with messaging and meeting scheduling
  - Complete Navigation with proper routing and controller integration

### Enhanced Forms System
- **Files**: `public/assets/enhanced-forms.js`, `public/assets/enhanced-forms.css`, enhanced form pages
- **Features**:
  - Real-time validation with visual feedback
  - Password strength indicators with requirements and visual meters
  - Loading states for form submission with button animations
  - Character counters for text areas and input limits
  - File upload enhancements with preview and validation
  - Auto-save functionality for long forms
  - Enhanced login/register forms with modern UX

### Reusable Component Library
- **Files**: `public/assets/component-library.js`, `public/assets/component-library.css`, `resources/views/demo/component-library.php`
- **Features**:
  - Modal System with customizable sizes and content
  - Card Components with variants and actions
  - Form Generation from JSON configuration
  - Table Components with sorting, searching, and pagination
  - Navigation Components with tabs and content management
  - Chart Integration with Chart.js support
  - Alert System with dismissible and auto-hide functionality
  - Dropdown Menus with actions and styling
  - Tooltip System with positioning options
  - Utility Components for common UI patterns

### Notification System
- **Files**: `public/assets/notification-system.js`
- **Features**:
  - Toast notifications with different types
  - Auto-dismiss functionality
  - Positioning options
  - Custom styling support

## New Files Created

### CSS Files
- `public/assets/sidebar-complete.css` - Complete sidebar system styles
- `public/assets/chart-fixes.css` - Chart height and layout fixes
- `public/assets/dashboard-layout.css` - Dashboard layout and dark mode fixes
- `public/assets/enhanced-forms.css` - Enhanced forms system styles
- `public/assets/component-library.css` - Reusable component library styles

### JavaScript Files
- `public/assets/sidebar-complete.js` - Complete sidebar system logic
- `public/assets/dashboard-mobile.js` - Mobile dashboard functionality
- `public/assets/create-parent-form.js` - Create parent form validation
- `public/assets/enhanced-forms.js` - Enhanced forms system logic
- `public/assets/component-library.js` - Reusable component library logic
- `public/assets/notification-system.js` - Reusable notification system
- `public/assets/admin-dashboard-enhanced.js` - Enhanced dashboard functionality
- `public/assets/admin-settings.js` - Admin settings page logic
- `public/assets/admin-reports.js` - Reports page functionality
- `public/assets/admin-logs.js` - System logs page functionality

### PHP View Files
- `resources/views/admin/settings.php` - Admin settings page
- `resources/views/admin/reports.php` - Reports and analytics page
- `resources/views/admin/logs.php` - System logs page
- `resources/views/teacher/dashboard.php` - Enhanced teacher dashboard
- `resources/views/teacher/grades.php` - Teacher grade management page
- `resources/views/teacher/classes.php` - Teacher class management page
- `resources/views/teacher/assignments.php` - Teacher assignment management page
- `resources/views/teacher/student-progress.php` - Teacher student progress tracking page
- `resources/views/teacher/attendance.php` - Teacher attendance management page
- `resources/views/teacher/communication.php` - Teacher communication and messaging page
- `resources/views/teacher/materials.php` - Teacher resources and materials page
- `resources/views/student/dashboard.php` - Enhanced student dashboard
- `resources/views/student/grades.php` - Student grades with interactive charts
- `resources/views/student/assignments.php` - Student assignments management
- `resources/views/student/profile.php` - Student profile management
- `resources/views/parent/dashboard.php` - Enhanced parent dashboard
- `resources/views/adviser/dashboard.php` - Adviser dashboard
- `resources/views/adviser/students.php` - Adviser student management
- `resources/views/adviser/performance.php` - Adviser performance tracking
- `resources/views/adviser/communication.php` - Adviser communication center
- `resources/views/demo/component-library.php` - Component library demo

## Views Added/Updated

- `resources/views/grade/index.php`
  - Grade management UI for teachers/admins
  - Features: stats cards, filters, grade table, add grade modal, validation helpers
  - Expected routes: `GET /grade`, `POST /grade` (create), optional `PUT /grade/{id}`, `DELETE /grade/{id}`

- `resources/views/grade/student-view.php`
  - Student/parent grade viewer with subject breakdown, detailed table, and print
  - Expected route: `GET /grade/student-view` (server-rendered) or `GET /api/grades?student_id=...` (AJAX)

- `resources/views/student/index.php`
  - Student management list with search, filters, bulk actions, add/view modals
  - Expected routes: `GET /students`, `POST /students`, `GET /students/{id}`, `PUT /students/{id}`, `DELETE /students/{id}`

- `resources/views/teacher/dashboard.php` (enhanced)
  - Quick actions to Grades and Alerts, My Sections cards, Recent Activity

- `resources/views/student/dashboard.php` (enhanced)
  - Academic overview, subject cards, recent activity, quick actions

- `resources/views/layouts/dashboard.php` (updated)
  - Added icons: `icon-edit`, `icon-delete`, `icon-filter`, `icon-search`

## CSS & Components

- Global tokens and theme in `public/assets/app.css`
- Reusable components: `.surface`, `.stat-card`, `.action-card`, `.table-surface`
- Utilities for forms, tables, badges, and cards

## Backend Integration Contracts

The UI currently uses placeholder data. Backend should expose endpoints compatible with these shapes.

### Grades

- Create Grade
  - Method: `POST /grade`
  - Body (application/x-www-form-urlencoded or JSON):
    - `student_id: number`
    - `subject_id: number`
    - `grade_type: 'ww' | 'pt' | 'qe'`
    - `grade_value: number (0-100)`
    - `quarter: 1|2|3|4`
    - `remarks?: string`
  - Response: redirect on success (server-rendered) or `{ success: true, id }` (AJAX)

- List Grades (table filters)
  - Method: `GET /grade`
  - Query params: `student_id?`, `subject_id?`, `grade_type?`, `quarter?`, `date_from?`, `date_to?`, `page?`
  - Response (server-rendered view) should receive `grades[]` with:
    - `id, student_name, subject_name, grade_type, quarter, grade_value, created_at`

- Student Grade Summary (student/parent view)
  - Method: `GET /api/grades/summary?student_id=...&quarter?`
  - Response JSON:
    ```json
    {
      "overallAverage": 85.2,
      "passingSubjects": 8,
      "needsImprovement": 2,
      "improvementRatePct": 3.2,
      "subjects": [
        {
          "name": "Mathematics",
          "overall": 87.5,
          "breakdown": { "ww": 85, "pt": 88, "qe": 90 },
          "status": "passed"
        }
      ],
      "items": [
        {"subject":"Mathematics","type":"ww","description":"Algebra Quiz #1","score":85,"max":100,"pct":85,"date":"2024-01-15"}
      ]
    }
    ```

### Students

- List Students
  - Method: `GET /students?search?=&grade_level?=&section?=&page?`
  - Response view data:
    - `students[]` with `id, name, email, lrn, grade_level, section, status, enrolled_at`

- Create Student
  - Method: `POST /students`
  - Body: `first_name, last_name, email, lrn?, grade_level, section_id, birth_date?, phone?, address?, parent_*?`
  - Response: redirect to `/students` with flash message

- Show Student
  - Method: `GET /students/{id}`
  - Response: view with detailed student profile

- Update/Delete Student
  - Methods: `PUT /students/{id}`, `DELETE /students/{id}`

### Auth & Role Guards

- All dashboard routes require `Session::get('user')`
- Teachers/Advisers: access to `/grade` and `/teacher/alerts`
- Students/Parents: access to `/grade/student-view`
- Admin: access to `/students` and admin modules

## Wiring Views to Routes (Server-rendered)

Add routes in `routes/web.php`:

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

Controller methods should call `$this->view->render('grade/index', $data, 'layouts/dashboard');` etc.

## Frontend Validation

- Basic client-side validation is in place for required fields and ranges
- Backend must re-validate and return safe errors

## Print and Accessibility

- Student grade view includes basic print styles
- Use semantic HTML and ensure contrast for dark/light themes

## Micro-interactions & Loading

- Animated counters: Any element with `data-count-to` (and optional `data-count-decimals`) will animate to its target value. Powered by `public/assets/app.js`.
- Progress animations: Add `data-progress-to="87.5"` to a progress bar's `.progress-bar` to animate width on first paint.
- Skeleton loaders: Add the `skeleton` class to placeholder blocks while data loads; remove it after real data is rendered.
- Scroll entrance: `.surface` and `.action-card` fade-in on first entry to viewport.

### Demo loading behavior (to be replaced by backend events)

In `grade/index.php` and `student/index.php` we added a short demo swap (700–750ms) that hides skeleton rows and shows real table content after `DOMContentLoaded`. Replace these with real data-load events once wired to the backend.

Example (replace timeout with actual data-ready logic):

```javascript
document.addEventListener('DOMContentLoaded', function(){
  const sk = document.getElementById('studentsSkeleton');
  const body = document.getElementById('studentsBody');
  // Replace this timeout with: fetch(...).then(() => { sk.style.display='none'; body.style.display=''; })
  setTimeout(() => { sk.style.display = 'none'; body.style.display = ''; }, 750);
});
```

---

For comprehensive system docs, see the main `README.md`. For database design, see `docs/ERD_NOTES.md`. For assistant-specific notes, see `docs/AI_IDE.md`.
