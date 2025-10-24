<?php
$title = $title ?? 'Add Students to Sections';
$user = $user ?? null;
$activeNav = $activeNav ?? 'students';
$sections = $sections ?? [];
$error = $error ?? null;
?>

<div class="container-fluid">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1">Add Students to Sections</h1>
          <p class="text-muted mb-0">Add students to your sections using their LRN (Learner Reference Number)</p>
        </div>
        <div class="d-flex gap-2">
          <a href="<?= \Helpers\Url::to('/teacher/students') ?>" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-users"></use>
            </svg>
            My Students
          </a>
          <a href="<?= \Helpers\Url::to('/teacher/advised-sections') ?>" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-sections"></use>
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

  <!-- LRN Search Section -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">
            <svg width="20" height="20" fill="currentColor" class="me-2">
              <use href="#icon-search"></use>
            </svg>
            Search Student by LRN
          </h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-8">
              <label for="lrnInput" class="form-label">LRN (Learner Reference Number)</label>
              <input type="text" class="form-control" id="lrnInput" placeholder="Enter student's LRN..." maxlength="20">
              <div class="form-text">
                <svg width="14" height="14" fill="currentColor" class="me-1">
                  <use href="#icon-info"></use>
                </svg>
                Enter the student's LRN to search for their information
              </div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button type="button" class="btn btn-primary w-100" onclick="searchStudent()">
                <svg width="16" height="16" fill="currentColor" class="me-2">
                  <use href="#icon-search"></use>
                </svg>
                Search Student
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Results -->
  <div class="row mb-4" id="searchResults" style="display: none;">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">
            <svg width="20" height="20" fill="currentColor" class="me-2">
              <use href="#icon-user"></use>
            </svg>
            Student Information
          </h5>
        </div>
        <div class="card-body">
          <div id="studentInfo">
            <!-- Student information will be loaded here -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Available Sections -->
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">
            <svg width="20" height="20" fill="currentColor" class="me-2">
              <use href="#icon-sections"></use>
            </svg>
            Your Sections
          </h5>
        </div>
        <div class="card-body p-0">
          <?php if (empty($sections)): ?>
            <div class="text-center py-5">
              <svg width="64" height="64" fill="currentColor" class="text-muted mb-3">
                <use href="#icon-sections"></use>
              </svg>
              <h5 class="text-muted">No Sections Available</h5>
              <p class="text-muted">You don't have any sections assigned to you yet. Contact the administrator to assign you to sections.</p>
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th class="border-0">Section</th>
                    <th class="border-0">Grade Level</th>
                    <th class="border-0">Room</th>
                    <th class="border-0">Classes</th>
                    <th class="border-0">Enrolled Students</th>
                    <th class="border-0">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sections as $section): ?>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <svg width="16" height="16" fill="currentColor" class="text-primary">
                              <use href="#icon-sections"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-0"><?= htmlspecialchars($section['name']) ?></h6>
                            <small class="text-muted">ID: <?= $section['id'] ?></small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-info">Grade <?= $section['grade_level'] ?></span>
                      </td>
                      <td>
                        <span class="text-muted"><?= htmlspecialchars($section['room']) ?></span>
                      </td>
                      <td>
                        <span class="badge bg-primary"><?= $section['total_classes'] ?></span>
                      </td>
                      <td>
                        <span class="badge bg-success"><?= $section['enrolled_students'] ?></span>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addStudentToSection(<?= $section['id'] ?>, '<?= htmlspecialchars($section['name']) ?>')" disabled id="addBtn_<?= $section['id'] ?>">
                          <svg width="16" height="16" fill="currentColor" class="me-1">
                            <use href="#icon-user-plus"></use>
                          </svg>
                          Add Student
                        </button>
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

<!-- Success/Error Messages -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="messageToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <svg width="20" height="20" fill="currentColor" class="me-2" id="toastIcon">
        <use href="#icon-check"></use>
      </svg>
      <strong class="me-auto" id="toastTitle">Success</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastMessage">
      <!-- Message will be set here -->
    </div>
  </div>
</div>

<script>
let currentStudent = null;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Search student by LRN
function searchStudent() {
  const lrn = document.getElementById('lrnInput').value.trim();
  
  if (!lrn) {
    showToast('error', 'Error', 'Please enter a LRN');
    return;
  }

  // Show loading state
  const searchBtn = document.querySelector('button[onclick="searchStudent()"]');
  const originalText = searchBtn.innerHTML;
  searchBtn.innerHTML = '<svg width="16" height="16" fill="currentColor" class="me-2"><use href="#icon-loader"></use></svg>Searching...';
  searchBtn.disabled = true;

  fetch(`/teacher/api/search-student?lrn=${encodeURIComponent(lrn)}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': csrfToken
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      currentStudent = data.student;
      displayStudentInfo(data.student, data.available_sections);
      showToast('success', 'Success', 'Student found successfully');
    } else {
      showToast('error', 'Error', data.error || 'Student not found');
      hideSearchResults();
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showToast('error', 'Error', 'An error occurred while searching for the student');
    hideSearchResults();
  })
  .finally(() => {
    // Restore button state
    searchBtn.innerHTML = originalText;
    searchBtn.disabled = false;
  });
}

// Display student information
function displayStudentInfo(student, availableSections) {
  const studentInfo = document.getElementById('studentInfo');
  
  studentInfo.innerHTML = `
    <div class="row g-4">
      <div class="col-md-6">
        <div class="bg-light rounded p-3">
          <h6 class="mb-3">Student Details</h6>
          <div class="row g-2">
            <div class="col-4"><strong>Name:</strong></div>
            <div class="col-8">${student.full_name}</div>
            <div class="col-4"><strong>LRN:</strong></div>
            <div class="col-8"><span class="badge bg-secondary">${student.lrn}</span></div>
            <div class="col-4"><strong>Grade:</strong></div>
            <div class="col-8"><span class="badge bg-info">Grade ${student.grade_level}</span></div>
            <div class="col-4"><strong>Email:</strong></div>
            <div class="col-8">${student.email}</div>
            <div class="col-4"><strong>Contact:</strong></div>
            <div class="col-8">${student.contact_number || 'Not provided'}</div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-light rounded p-3">
          <h6 class="mb-3">Current Status</h6>
          <div class="row g-2">
            <div class="col-4"><strong>Current Section:</strong></div>
            <div class="col-8">${student.current_section || 'Not assigned'}</div>
            <div class="col-4"><strong>Status:</strong></div>
            <div class="col-8"><span class="badge ${student.user_status === 'active' ? 'bg-success' : 'bg-warning'}">${student.user_status}</span></div>
            <div class="col-4"><strong>Address:</strong></div>
            <div class="col-8">${student.address || 'Not provided'}</div>
          </div>
        </div>
      </div>
    </div>
    
    ${availableSections.length > 0 ? `
      <div class="mt-4">
        <h6 class="mb-3">Available Sections for Grade ${student.grade_level}</h6>
        <div class="row g-3">
          ${availableSections.map(section => `
            <div class="col-md-6">
              <div class="card border-0 bg-white">
                <div class="card-body">
                  <h6 class="card-title">${section.name}</h6>
                  <p class="card-text text-muted">Room: ${section.room}</p>
                  <button type="button" class="btn btn-primary btn-sm" onclick="addStudentToSection(${section.id}, '${section.name}')">
                    <svg width="16" height="16" fill="currentColor" class="me-1">
                      <use href="#icon-user-plus"></use>
                    </svg>
                    Add to this Section
                  </button>
                </div>
              </div>
            </div>
          `).join('')}
        </div>
      </div>
    ` : `
      <div class="mt-4">
        <div class="alert alert-warning">
          <svg width="20" height="20" fill="currentColor" class="me-2">
            <use href="#icon-alert-triangle"></use>
          </svg>
          No sections available for Grade ${student.grade_level}. You may not be assigned to teach this grade level.
        </div>
      </div>
    `}
  `;

  // Show search results
  document.getElementById('searchResults').style.display = 'block';
  
  // Enable add buttons for matching grade levels
  document.querySelectorAll('button[id^="addBtn_"]').forEach(btn => {
    const sectionId = btn.id.replace('addBtn_', '');
    const section = availableSections.find(s => s.id == sectionId);
    if (section) {
      btn.disabled = false;
    }
  });
}

// Hide search results
function hideSearchResults() {
  document.getElementById('searchResults').style.display = 'none';
  currentStudent = null;
  
  // Disable all add buttons
  document.querySelectorAll('button[id^="addBtn_"]').forEach(btn => {
    btn.disabled = true;
  });
}

// Add student to section
function addStudentToSection(sectionId, sectionName) {
  if (!currentStudent) {
    showToast('error', 'Error', 'Please search for a student first');
    return;
  }

  if (!confirm(`Are you sure you want to add ${currentStudent.full_name} (LRN: ${currentStudent.lrn}) to ${sectionName}?`)) {
    return;
  }

  const formData = new FormData();
  formData.append('csrf_token', csrfToken);
  formData.append('student_id', currentStudent.id);
  formData.append('section_id', sectionId);

  fetch('/teacher/api/add-student', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showToast('success', 'Success', data.message);
      // Clear search and reset form
      document.getElementById('lrnInput').value = '';
      hideSearchResults();
    } else {
      showToast('error', 'Error', data.error || 'Failed to add student to section');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showToast('error', 'Error', 'An error occurred while adding the student');
  });
}

// Show toast notification
function showToast(type, title, message) {
  const toast = document.getElementById('messageToast');
  const toastIcon = document.getElementById('toastIcon');
  const toastTitle = document.getElementById('toastTitle');
  const toastMessage = document.getElementById('toastMessage');

  // Set icon based on type
  const iconMap = {
    'success': '#icon-check',
    'error': '#icon-alert-circle',
    'warning': '#icon-alert-triangle',
    'info': '#icon-info'
  };

  toastIcon.innerHTML = `<use href="${iconMap[type] || '#icon-info'}"></use>`;
  toastTitle.textContent = title;
  toastMessage.textContent = message;

  // Show toast
  const bsToast = new bootstrap.Toast(toast);
  bsToast.show();
}

// Allow Enter key to search
document.getElementById('lrnInput').addEventListener('keypress', function(e) {
  if (e.key === 'Enter') {
    searchStudent();
  }
});

// Clear search when LRN input changes
document.getElementById('lrnInput').addEventListener('input', function() {
  if (this.value.trim() === '') {
    hideSearchResults();
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

.table tbody tr:hover {
  background-color: var(--bs-gray-50);
}

.toast {
  min-width: 300px;
}

.bg-light {
  background-color: var(--bs-gray-100) !important;
}

#lrnInput:focus {
  border-color: var(--bs-primary);
  box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
}
</style>
