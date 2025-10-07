# User Management System

## Overview

The student monitoring system now implements a proper user management system where administrators have full control over user account creation and approval. This ensures security and proper access control.

## User Registration Flow

### 1. Students
- **Self-Registration**: Students can register themselves through the public registration form
- **Status**: Accounts are created with `pending` status
- **Approval Required**: Admin must approve before students can log in
- **Notification**: Students receive a message that their account is pending approval

### 2. Teachers
- **Admin-Only Creation**: Teachers cannot self-register
- **Created by Admin**: Only administrators can create teacher accounts
- **Immediate Access**: Teacher accounts are created with `active` status
- **No Approval Needed**: Teachers can log in immediately after creation

### 3. Parents
- **Admin-Only Creation**: Parents cannot self-register
- **Student Linking**: Parents must be linked to specific students
- **Relationship Tracking**: System tracks relationship (father, mother, guardian)
- **Immediate Access**: Parent accounts are created with `active` status

### 4. Administrators
- **Admin-Only Creation**: Only existing admins can create new admin accounts
- **Immediate Access**: Admin accounts are created with `active` status
- **Full Permissions**: Admins have complete system access

## Database Changes

### Users Table Updates
```sql
-- New columns added to users table
status ENUM('pending','active','suspended') DEFAULT 'pending'
requested_role ENUM('admin','teacher','adviser','student','parent') NULL
approved_by INT UNSIGNED NULL
approved_at TIMESTAMP NULL
```

### Parents Table Updates
```sql
-- New columns added to parents table
student_id INT UNSIGNED NULL
relationship ENUM('father','mother','guardian') DEFAULT 'guardian'
```

## Admin Dashboard Features

### 1. User Management Dashboard
- **Pending Approvals**: Shows count of users waiting for approval
- **User Statistics**: Displays active users by role
- **Quick Actions**: Direct links to user management functions

### 2. User Management Interface
- **View All Users**: Complete list with status, role, and approval info
- **Approve/Reject**: One-click approval or rejection of pending users
- **Suspend/Activate**: Manage active and suspended users
- **Filter Options**: Filter by status and role

### 3. User Creation
- **Create General Users**: For teachers, admins, and other staff
- **Create Parent Accounts**: Special form for linking parents to students
- **Role Selection**: Choose appropriate role and permissions
- **Status Control**: Set initial account status

## Security Features

### 1. Account Status Control
- **Pending**: New registrations awaiting approval
- **Active**: Approved users who can log in
- **Suspended**: Temporarily disabled accounts

### 2. Login Protection
- **Status Check**: Login blocked for non-active accounts
- **Clear Messages**: Users informed why they cannot log in
- **Admin Contact**: Guidance to contact administrator

### 3. CSRF Protection
- **All Forms**: CSRF tokens on all user management forms
- **Secure Actions**: Approval, suspension, and creation actions protected

## Setup Instructions

### 1. Database Setup
```bash
# Run the schema update script
php database/update_schema.php
```

### 2. Create Initial Admin
```bash
# Create the first admin user
php database/init_admin.php
```

### 3. Default Admin Credentials
- **Email**: admin@school.edu
- **Password**: admin123
- **⚠️ Change password after first login!**

## User Workflows

### Student Registration Workflow
1. Student visits `/register`
2. Fills out registration form
3. Account created with `pending` status
4. Student sees "pending approval" message
5. Admin reviews in `/admin/users`
6. Admin approves or rejects
7. If approved, student can log in

### Teacher Creation Workflow
1. Admin goes to `/admin/create-user`
2. Selects "Teacher" role
3. Fills out teacher details
4. Account created with `active` status
5. Teacher can log in immediately

### Parent Creation Workflow
1. Admin goes to `/admin/create-parent`
2. Selects student to link parent to
3. Fills out parent details and relationship
4. Account created with `active` status
5. Parent can log in and see only their child's info

## Benefits

### 1. Security
- **Controlled Access**: Only approved users can access the system
- **Role-Based Permissions**: Users only see what they need to see
- **Audit Trail**: Track who approved which users

### 2. Administration
- **Centralized Control**: All user management in one place
- **Bulk Operations**: Easy approval of multiple users
- **Status Management**: Suspend/activate users as needed

### 3. User Experience
- **Clear Communication**: Users know their account status
- **Proper Workflows**: Logical process for account creation
- **Secure Access**: Only authorized users can access sensitive data

## Future Enhancements

### 1. Email Notifications
- Send approval/rejection emails to users
- Notify admins of new registrations
- Password reset functionality

### 2. Bulk Operations
- Bulk approve multiple users
- Import users from CSV
- Export user lists

### 3. Advanced Permissions
- Role-based access control
- Permission inheritance
- Custom permission sets

This system provides a solid foundation for secure user management in the student monitoring platform.
