# Database Design Notes - Smart Student Monitoring System

## 🗄 Current Database Schema (Phase 1)

### Core Tables

#### Users Table
```sql
users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role ENUM('admin','teacher','adviser','student','parent') NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(191) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
```
**Purpose**: Central authentication table for all user types

#### Student Profile Table
```sql
students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    lrn VARCHAR(20) UNIQUE,
    grade_level TINYINT UNSIGNED,
    section_id INT UNSIGNED NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
```
**Purpose**: Extended student information linked to user account

#### Teacher Profile Table
```sql
teachers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    is_adviser TINYINT(1) DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
```
**Purpose**: Extended teacher information with adviser flag

#### Parent Profile Table
```sql
parents (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
```
**Purpose**: Extended parent information linked to user account

### Academic Structure

#### Subjects Table
```sql
subjects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(191) NOT NULL,
    grade_level TINYINT UNSIGNED NOT NULL,
    ww_percent TINYINT UNSIGNED DEFAULT 30,  -- Written Work %
    pt_percent TINYINT UNSIGNED DEFAULT 50,  -- Performance Task %
    qe_percent TINYINT UNSIGNED DEFAULT 20   -- Quarterly Exam %
)
```
**Purpose**: Subject definitions with grade weight configurations

#### Sections Table
```sql
sections (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    grade_level TINYINT UNSIGNED NOT NULL,
    adviser_teacher_id INT UNSIGNED NULL,
    FOREIGN KEY (adviser_teacher_id) REFERENCES teachers(id)
)
```
**Purpose**: Class sections with assigned advisers

#### Enrollments Table
```sql
enrollments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    section_id INT UNSIGNED NOT NULL,
    school_year VARCHAR(20) NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (section_id) REFERENCES sections(id)
)
```
**Purpose**: Links students to sections per school year

## 🔗 Key Relationships

### User Role System
```
users (1) ←→ (0..1) students
users (1) ←→ (0..1) teachers  
users (1) ←→ (0..1) parents
```
- **One-to-One**: Each user can have one role-specific profile
- **Role-based**: Users are identified by `role` enum field

### Academic Relationships
```
teachers (1) ←→ (0..*) sections (as adviser)
students (*) ←→ (*) sections (via enrollments)
sections (1) ←→ (*) enrollments
students (1) ←→ (*) enrollments
```

### Grade Level Organization
```
subjects → grade_level (1-12)
sections → grade_level (1-12)
students → grade_level (1-12)
```

## 📊 Planned Tables (Phase 2+)

### Grade Management
```sql
-- Individual grade entries
grades (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    subject_id INT UNSIGNED NOT NULL,
    grade_value DECIMAL(5,2) NOT NULL,
    grade_type ENUM('ww','pt','qe') NOT NULL,
    quarter TINYINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
)

-- Grade components/items
grade_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_id INT UNSIGNED NOT NULL,
    name VARCHAR(191) NOT NULL,
    max_points DECIMAL(5,2) NOT NULL,
    grade_type ENUM('ww','pt','qe') NOT NULL,
    quarter TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
)

-- Quarterly grade summaries
quarterly_grades (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    subject_id INT UNSIGNED NOT NULL,
    quarter TINYINT UNSIGNED NOT NULL,
    ww_average DECIMAL(5,2),
    pt_average DECIMAL(5,2),
    qe_average DECIMAL(5,2),
    final_grade DECIMAL(5,2),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
)
```

### Attendance System
```sql
attendance (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT UNSIGNED NOT NULL,
    date DATE NOT NULL,
    status ENUM('present','absent','late','excused') NOT NULL,
    remarks TEXT NULL,
    recorded_by INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (recorded_by) REFERENCES users(id)
)
```

### Notification System
```sql
alerts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    type ENUM('grade','attendance','behavior','system') NOT NULL,
    title VARCHAR(191) NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
```

### Audit & Logging
```sql
audit_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    action VARCHAR(191) NOT NULL,
    table_name VARCHAR(64) NOT NULL,
    record_id INT UNSIGNED NULL,
    old_values JSON NULL,
    new_values JSON NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
```

## 🎯 Design Principles

### 1. Normalization
- **3NF Compliance**: Eliminates data redundancy
- **Separate Concerns**: User authentication vs. profile data
- **Flexible Roles**: Single user table with role-based profiles

### 2. Scalability
- **Grade Level Support**: 1-12 grade levels
- **Multi-Year Support**: School year tracking in enrollments
- **Extensible**: Easy to add new user types or features

### 3. Data Integrity
- **Foreign Key Constraints**: Maintain referential integrity
- **Unique Constraints**: Prevent duplicate data (LRN, email)
- **Enum Types**: Restrict values to valid options

### 4. Performance
- **Indexed Fields**: Primary keys, foreign keys, unique fields
- **Appropriate Data Types**: Optimized storage sizes
- **JSON Fields**: Flexible data storage for audit logs

## 🔄 Migration Strategy

### Phase 1 → Phase 2
1. **Add Grade Tables**: Implement grade management system
2. **Add Attendance**: Implement attendance tracking
3. **Add Alerts**: Implement notification system
4. **Add Audit Logs**: Implement activity tracking

### Data Migration Considerations
- **Backup Strategy**: Full database backup before migrations
- **Rollback Plan**: Ability to revert schema changes
- **Data Validation**: Ensure data integrity after migrations
- **Performance Testing**: Verify query performance with new tables

## 📈 Future Enhancements

### Advanced Features
- **Parent-Student Linking**: Connect parents to their children
- **Teacher-Subject Assignment**: Assign teachers to specific subjects
- **Grade Categories**: Custom grade categories per subject
- **Attendance Reports**: Automated attendance reporting
- **Behavior Tracking**: Student behavior monitoring
- **Communication Log**: Parent-teacher communication history

### Integration Points
- **SMS Notifications**: Integration with SMS services
- **Email System**: Automated email notifications
- **File Uploads**: Document and image storage
- **API Endpoints**: RESTful API for mobile apps
- **Reporting Engine**: Advanced analytics and reporting

---

**For complete database schema, see [database/schema.sql](../database/schema.sql)**


