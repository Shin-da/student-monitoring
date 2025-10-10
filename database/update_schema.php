<?php
/**
 * Database Schema Update Script (Centralized Schema)
 * Goal: Keep only `users` table and migrate/link role-specific data into it.
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

use Core\Database;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);

    echo "🔄 Updating database schema to centralized model...\n";

    // Ensure required base columns exist on users
    $ensureColumn = function (string $name, string $definition) use ($pdo) {
        $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE :col");
        $stmt->execute(['col' => $name]);
        if (!$stmt->fetch()) {
            echo "Adding users.$name column...\n";
            $pdo->exec("ALTER TABLE users ADD COLUMN $definition");
        }
    };

    $ensureColumn('status', "status ENUM('pending','active','suspended') DEFAULT 'pending'");
    $ensureColumn('requested_role', "requested_role ENUM('admin','teacher','adviser','student','parent') NULL");
    $ensureColumn('approved_by', 'approved_by INT UNSIGNED NULL');
    // Foreign key for approved_by (if not already present)
    try { $pdo->exec('ALTER TABLE users ADD CONSTRAINT fk_users_approved_by FOREIGN KEY (approved_by) REFERENCES users(id)'); } catch (\Throwable $e) {}
    $ensureColumn('approved_at', 'approved_at TIMESTAMP NULL');

    // Centralized role-specific fields on users
    // Student fields
    $ensureColumn('lrn', 'lrn VARCHAR(20) NULL');
    $ensureColumn('grade_level', 'grade_level TINYINT UNSIGNED NULL');
    $ensureColumn('section_name', 'section_name VARCHAR(50) NULL');
    // Parent linking (self-join to users)
    $ensureColumn('linked_student_user_id', 'linked_student_user_id INT UNSIGNED NULL');
    try { $pdo->exec('ALTER TABLE users ADD CONSTRAINT fk_users_linked_student FOREIGN KEY (linked_student_user_id) REFERENCES users(id)'); } catch (\Throwable $e) {}
    $ensureColumn('parent_relationship', "parent_relationship ENUM('father','mother','guardian') NULL");
    // Teacher/adviser
    $ensureColumn('is_adviser', 'is_adviser TINYINT(1) NOT NULL DEFAULT 0');

    // Optional migration: move data from legacy tables into users if they exist
    $tableExists = function (string $table) use ($pdo): bool {
        $stmt = $pdo->prepare("SHOW TABLES LIKE :t");
        $stmt->execute(['t' => $table]);
        return (bool) $stmt->fetchColumn();
    };

    if ($tableExists('students')) {
        echo "Migrating students → users.lrn, users.grade_level...\n";
        // Copy known fields where mapping exists
        $pdo->exec(
            "UPDATE users u JOIN students s ON s.user_id = u.id 
             SET u.lrn = s.lrn, u.grade_level = s.grade_level"
        );
    }

    if ($tableExists('teachers')) {
        echo "Migrating teachers → users.is_adviser...\n";
        $pdo->exec(
            "UPDATE users u JOIN teachers t ON t.user_id = u.id 
             SET u.is_adviser = IFNULL(t.is_adviser, 0)"
        );
    }

    if ($tableExists('parents')) {
        echo "Migrating parents → users.linked_student_user_id, users.parent_relationship...\n";
        // Link parent user to student user via students.user_id
        $pdo->exec(
            "UPDATE users pu 
             JOIN parents p ON p.user_id = pu.id 
             LEFT JOIN students s ON s.id = p.student_id 
             LEFT JOIN users su ON su.id = s.user_id 
             SET pu.linked_student_user_id = su.id, pu.parent_relationship = p.relationship"
        );
    }

    // Drop legacy tables (if they exist)
    $legacyTables = ['enrollments', 'parents', 'sections', 'students', 'subjects', 'teachers'];
    foreach ($legacyTables as $tbl) {
        if ($tableExists($tbl)) {
            echo "Dropping table `$tbl`...\n";
            $pdo->exec("DROP TABLE `$tbl`");
        }
    }

    // Housekeeping: set pending→active if desired
    echo "Normalizing user statuses...\n";
    $pdo->exec("UPDATE users SET status = 'active' WHERE status IS NULL OR status = 'pending'");

    // Create sections and section_students tables for teacher module (centralized users-based FKs)
    echo "Ensuring sections tables exist...\n";
    $pdo->exec("CREATE TABLE IF NOT EXISTS sections (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        teacher_user_id INT UNSIGNED NOT NULL,
        section_name VARCHAR(100) NOT NULL,
        grade_level TINYINT UNSIGNED NOT NULL,
        description TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_sections_teacher_user FOREIGN KEY (teacher_user_id) REFERENCES users(id) ON DELETE CASCADE,
        CONSTRAINT uq_sections_teacher_name UNIQUE (teacher_user_id, section_name)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS section_students (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        section_id INT UNSIGNED NOT NULL,
        student_user_id INT UNSIGNED NOT NULL,
        added_by_user_id INT UNSIGNED NOT NULL,
        date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_section_students_section FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE CASCADE,
        CONSTRAINT fk_section_students_student_user FOREIGN KEY (student_user_id) REFERENCES users(id) ON DELETE CASCADE,
        CONSTRAINT fk_section_students_added_by_user FOREIGN KEY (added_by_user_id) REFERENCES users(id) ON DELETE CASCADE,
        CONSTRAINT uq_section_student UNIQUE (section_id, student_user_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

    echo "✅ Centralized schema update completed. Only `users` table remains.\n";

} catch (Exception $e) {
    echo "❌ Error updating schema: " . $e->getMessage() . "\n";
}
