<?php
$title = $title ?? 'My Students';
$user = $user ?? null;
$activeNav = $activeNav ?? 'students';
$students = $students ?? [];
$statistics = $statistics ?? [];
$error = $error ?? null;
?>

<div class="container-fluid">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1">My Students</h1>
          <p class="text-muted mb-0">Students you handle based on your subject assignments</p>
        </div>
        <div class="d-flex gap-2">
          <a href="<?= \Helpers\Url::to('/teacher/add-students') ?>" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-user-plus"></use>
            </svg>
            Add Students
          </a>
          <a href="<?= \Helpers\Url::to('/teacher/advised-sections') ?>" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-users"></use>
            </svg>
            My Sections
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Error Message -->
  <?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <div class="d-flex align-items-center">
        <svg width="20" height="20" fill="currentColor" class="me-3">
          <use href="#icon-alert-circle"></use>
        </svg>
        <div>
          <strong>Error!</strong> <?= htmlspecialchars($error) ?>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Statistics Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card border-0 bg-primary bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-primary mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-users"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= $statistics['total_students'] ?? 0 ?></h4>
          <p class="text-muted mb-0">Total Students</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-success bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-success mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-graduation-cap"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= $statistics['grade_levels'] ?? 0 ?></h4>
          <p class="text-muted mb-0">Grade Levels</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-info bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-info mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-sections"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= $statistics['sections'] ?? 0 ?></h4>
          <p class="text-muted mb-0">Sections</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-warning bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-warning mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-book"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= count($students) > 0 ? array_sum(array_column($students, 'total_classes')) : 0 ?></h4>
          <p class="text-muted mb-0">Total Classes</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-4">
              <label for="gradeFilter" class="form-label">Filter by Grade Level</label>
              <select class="form-select" id="gradeFilter">
                <option value="">All Grade Levels</option>
                <?php foreach ($statistics['grade_levels_list'] ?? [] as $grade): ?>
                  <option value="<?= $grade ?>">Grade <?= $grade ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="sectionFilter" class="form-label">Filter by Section</label>
              <select class="form-select" id="sectionFilter">
                <option value="">All Sections</option>
                <?php foreach ($statistics['sections_list'] ?? [] as $section): ?>
                  <option value="<?= htmlspecialchars($section) ?>"><?= htmlspecialchars($section) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="searchInput" class="form-label">Search Students</label>
              <input type="text" class="form-control" id="searchInput" placeholder="Search by name or LRN...">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Students List -->
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
              <svg width="20" height="20" fill="currentColor" class="me-2">
                <use href="#icon-users"></use>
              </svg>
              Student List
            </h5>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-primary" onclick="refreshStudents()">
                <svg width="16" height="16" fill="currentColor" class="me-1">
                  <use href="#icon-refresh-cw"></use>
                </svg>
                Refresh
              </button>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <?php if (empty($students)): ?>
            <div class="text-center py-5">
              <svg width="64" height="64" fill="currentColor" class="text-muted mb-3">
                <use href="#icon-users"></use>
              </svg>
              <h5 class="text-muted">No Students Found</h5>
              <p class="text-muted">You don't have any students assigned to your classes yet.</p>
              <a href="<?= \Helpers\Url::to('/teacher/add-students') ?>" class="btn btn-primary">
                <svg width="16" height="16" fill="currentColor" class="me-2">
                  <use href="#icon-user-plus"></use>
                </svg>
                Add Students to Your Sections
              </a>
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover mb-0" id="studentsTable">
                <thead class="table-light">
                  <tr>
                    <th class="border-0">Student</th>
                    <th class="border-0">LRN</th>
                    <th class="border-0">Grade Level</th>
                    <th class="border-0">Section</th>
                    <th class="border-0">Subjects</th>
                    <th class="border-0">Schedule</th>
                    <th class="border-0">Classes</th>
                    <th class="border-0 text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($students as $student): ?>
                    <tr data-grade="<?= $student['grade_level'] ?>" data-section="<?= htmlspecialchars($student['section_name']) ?>">
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <svg width="16" height="16" fill="currentColor" class="text-primary">
                              <use href="#icon-user"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-0"><?= htmlspecialchars($student['full_name']) ?></h6>
                            <small class="text-muted">ID: <?= $student['student_id'] ?></small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-secondary"><?= htmlspecialchars($student['lrn']) ?></span>
                      </td>
                      <td>
                        <span class="badge bg-info">Grade <?= $student['grade_level'] ?></span>
                      </td>
                      <td>
                        <span class="text-muted"><?= htmlspecialchars($student['section_name']) ?></span>
                      </td>
                      <td>
                        <div class="text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($student['subjects']) ?>">
                          <?= htmlspecialchars($student['subjects']) ?>
                        </div>
                      </td>
                      <td>
                        <div class="text-truncate" style="max-width: 150px;" title="<?= htmlspecialchars($student['schedules']) ?>">
                          <?= htmlspecialchars($student['schedules']) ?>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-primary"><?= $student['total_classes'] ?></span>
                      </td>
                      <td class="text-end">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewStudentDetails(<?= $student['student_id'] ?>)">
                            <svg width="16" height="16" fill="currentColor">
                              <use href="#icon-eye"></use>
                            </svg>
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-info" onclick="viewStudentGrades(<?= $student['student_id'] ?>)">
                            <svg width="16" height="16" fill="currentColor">
                              <use href="#icon-chart"></use>
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Filter functionality
document.getElementById('gradeFilter').addEventListener('change', filterStudents);
document.getElementById('sectionFilter').addEventListener('change', filterStudents);
document.getElementById('searchInput').addEventListener('input', filterStudents);

function filterStudents() {
  const gradeFilter = document.getElementById('gradeFilter').value;
  const sectionFilter = document.getElementById('sectionFilter').value;
  const searchInput = document.getElementById('searchInput').value.toLowerCase();
  
  const rows = document.querySelectorAll('#studentsTable tbody tr');
  
  rows.forEach(row => {
    const grade = row.dataset.grade;
    const section = row.dataset.section;
    const studentName = row.querySelector('h6').textContent.toLowerCase();
    const lrn = row.querySelector('.badge').textContent.toLowerCase();
    
    let showRow = true;
    
    // Grade filter
    if (gradeFilter && grade !== gradeFilter) {
      showRow = false;
    }
    
    // Section filter
    if (sectionFilter && section !== sectionFilter) {
      showRow = false;
    }
    
    // Search filter
    if (searchInput && !studentName.includes(searchInput) && !lrn.includes(searchInput)) {
      showRow = false;
    }
    
    row.style.display = showRow ? '' : 'none';
  });
}

// Action functions
function viewStudentDetails(studentId) {
  // TODO: Implement student details modal
  alert('Student details for ID: ' + studentId);
}

function viewStudentGrades(studentId) {
  // TODO: Implement student grades view
  alert('Student grades for ID: ' + studentId);
}

function refreshStudents() {
  window.location.reload();
}

// Initialize filters
document.addEventListener('DOMContentLoaded', function() {
  // Auto-populate filters if there are students
  const students = <?= json_encode($students) ?>;
  if (students.length > 0) {
    // You can add any initialization logic here
  }
});
</script>

<style>
.table th {
  font-weight: 600;
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.btn-group .btn {
  border-radius: 0.375rem;
}

.btn-group .btn:not(:last-child) {
  margin-right: 0.25rem;
}

.card {
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.badge {
  font-size: 0.75rem;
  font-weight: 500;
}

.text-truncate {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.table tbody tr:hover {
  background-color: var(--bs-gray-50);
}
</style>
