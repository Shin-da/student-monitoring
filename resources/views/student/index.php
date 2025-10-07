<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Student Management</h1>
      <p class="text-muted mb-0">Manage student records and information</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-filter"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Filter</span>
      </button>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Add Student</span>
      </button>
    </div>
  </div>
</div>

<!-- Student Statistics Cards -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-primary-subtle text-primary">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-students"></use>
          </svg>
        </div>
        <span class="badge bg-primary-subtle text-primary">+12%</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="1247">0</h3>
      <p class="text-muted small mb-0">Total Students</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-success-subtle text-success">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <span class="badge bg-success-subtle text-success">95%</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="1185">0</h3>
      <p class="text-muted small mb-0">Active Students</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-warning-subtle text-warning">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <span class="badge bg-warning-subtle text-warning">62</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="62">0</h3>
      <p class="text-muted small mb-0">Inactive Students</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-info-subtle text-info">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-sections-admin"></use>
          </svg>
        </div>
        <span class="badge bg-info-subtle text-info">42</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="42">0</h3>
      <p class="text-muted small mb-0">Sections</p>
    </div>
  </div>
</div>

<!-- Student Management Table -->
<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Student Records</h5>
    <div class="d-flex gap-2">
      <div class="input-group" style="width: 250px;">
        <input type="text" class="form-control form-control-sm" placeholder="Search students..." id="searchInput">
        <button class="btn btn-outline-secondary btn-sm" type="button">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </button>
      </div>
      <select class="form-select form-select-sm" style="width: auto;" id="gradeFilter">
        <option value="">All Grades</option>
        <option value="7">Grade 7</option>
        <option value="8">Grade 8</option>
        <option value="9">Grade 9</option>
        <option value="10">Grade 10</option>
        <option value="11">Grade 11</option>
        <option value="12">Grade 12</option>
      </select>
      <select class="form-select form-select-sm" style="width: auto;" id="sectionFilter">
        <option value="">All Sections</option>
        <option value="10-a">Grade 10-A</option>
        <option value="10-b">Grade 10-B</option>
        <option value="10-c">Grade 10-C</option>
        <option value="9-a">Grade 9-A</option>
        <option value="9-b">Grade 9-B</option>
      </select>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>
            <input type="checkbox" class="form-check-input" id="selectAll">
          </th>
          <th>Student</th>
          <th>LRN</th>
          <th>Grade Level</th>
          <th>Section</th>
          <th>Status</th>
          <th>Enrollment Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- Skeleton rows while loading -->
      <tbody id="studentsSkeleton">
        <tr>
          <td colspan="8"><div class="skeleton" style="height: 18px; width: 100%;"></div></td>
        </tr>
        <tr>
          <td colspan="8"><div class="skeleton" style="height: 18px; width: 100%;"></div></td>
        </tr>
        <tr>
          <td colspan="8"><div class="skeleton" style="height: 18px; width: 100%;"></div></td>
        </tr>
      </tbody>
      <!-- Real data -->
      <tbody id="studentsBody" style="display:none">
        <tr>
          <td>
            <input type="checkbox" class="form-check-input" value="1">
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <div>
                <div class="fw-semibold">John Doe</div>
                <div class="text-muted small">john.doe@email.com</div>
              </div>
            </div>
          </td>
          <td><code>123456789012</code></td>
          <td><span class="badge bg-primary-subtle text-primary">Grade 10</span></td>
          <td>10-A</td>
          <td><span class="badge bg-success-subtle text-success">Active</span></td>
          <td>2024-01-15</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="View Details" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </button>
              <button class="btn btn-outline-secondary" title="Edit">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-edit"></use>
                </svg>
              </button>
              <button class="btn btn-outline-danger" title="Delete">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-delete"></use>
                </svg>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <input type="checkbox" class="form-check-input" value="2">
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <div>
                <div class="fw-semibold">Jane Smith</div>
                <div class="text-muted small">jane.smith@email.com</div>
              </div>
            </div>
          </td>
          <td><code>123456789013</code></td>
          <td><span class="badge bg-primary-subtle text-primary">Grade 10</span></td>
          <td>10-A</td>
          <td><span class="badge bg-success-subtle text-success">Active</span></td>
          <td>2024-01-15</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="View Details">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </button>
              <button class="btn btn-outline-secondary" title="Edit">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-edit"></use>
                </svg>
              </button>
              <button class="btn btn-outline-danger" title="Delete">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-delete"></use>
                </svg>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <input type="checkbox" class="form-check-input" value="3">
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <div>
                <div class="fw-semibold">Mike Johnson</div>
                <div class="text-muted small">mike.johnson@email.com</div>
              </div>
            </div>
          </td>
          <td><code>123456789014</code></td>
          <td><span class="badge bg-primary-subtle text-primary">Grade 10</span></td>
          <td>10-B</td>
          <td><span class="badge bg-warning-subtle text-warning">Inactive</span></td>
          <td>2024-01-15</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="View Details">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </button>
              <button class="btn btn-outline-secondary" title="Edit">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-edit"></use>
                </svg>
              </button>
              <button class="btn btn-outline-danger" title="Delete">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-delete"></use>
                </svg>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <input type="checkbox" class="form-check-input" value="4">
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <div>
                <div class="fw-semibold">Sarah Wilson</div>
                <div class="text-muted small">sarah.wilson@email.com</div>
              </div>
            </div>
          </td>
          <td><code>123456789015</code></td>
          <td><span class="badge bg-primary-subtle text-primary">Grade 9</span></td>
          <td>9-A</td>
          <td><span class="badge bg-success-subtle text-success">Active</span></td>
          <td>2024-01-15</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="View Details">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </button>
              <button class="btn btn-outline-secondary" title="Edit">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-edit"></use>
                </svg>
              </button>
              <button class="btn btn-outline-danger" title="Delete">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-delete"></use>
                </svg>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <!-- Bulk Actions -->
  <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" id="bulkEditBtn" disabled>
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-edit"></use>
        </svg>
        <span class="ms-1">Bulk Edit</span>
      </button>
      <button class="btn btn-outline-danger btn-sm" id="bulkDeleteBtn" disabled>
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-delete"></use>
        </svg>
        <span class="ms-1">Bulk Delete</span>
      </button>
    </div>
    
    <!-- Pagination -->
    <nav aria-label="Student pagination">
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addStudentForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="firstName" name="first_name" required>
              <div class="invalid-feedback">Please enter first name.</div>
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="lastName" name="last_name" required>
              <div class="invalid-feedback">Please enter last name.</div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div class="invalid-feedback">Please enter a valid email.</div>
            </div>
            <div class="col-md-6">
              <label for="lrn" class="form-label">LRN (Learner Reference Number)</label>
              <input type="text" class="form-control" id="lrn" name="lrn" maxlength="12">
              <div class="form-text">12-digit learner reference number</div>
            </div>
            <div class="col-md-6">
              <label for="gradeLevel" class="form-label">Grade Level <span class="text-danger">*</span></label>
              <select class="form-select" id="gradeLevel" name="grade_level" required>
                <option value="">Select Grade Level</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
                <option value="11">Grade 11</option>
                <option value="12">Grade 12</option>
              </select>
              <div class="invalid-feedback">Please select a grade level.</div>
            </div>
            <div class="col-md-6">
              <label for="section" class="form-label">Section <span class="text-danger">*</span></label>
              <select class="form-select" id="section" name="section_id" required>
                <option value="">Select Section</option>
                <option value="1">Grade 10-A</option>
                <option value="2">Grade 10-B</option>
                <option value="3">Grade 10-C</option>
                <option value="4">Grade 9-A</option>
                <option value="5">Grade 9-B</option>
              </select>
              <div class="invalid-feedback">Please select a section.</div>
            </div>
            <div class="col-md-6">
              <label for="birthDate" class="form-label">Birth Date</label>
              <input type="date" class="form-control" id="birthDate" name="birth_date">
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone">
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
            <div class="col-12">
              <label for="parentName" class="form-label">Parent/Guardian Name</label>
              <input type="text" class="form-control" id="parentName" name="parent_name">
            </div>
            <div class="col-md-6">
              <label for="parentEmail" class="form-label">Parent/Guardian Email</label>
              <input type="email" class="form-control" id="parentEmail" name="parent_email">
            </div>
            <div class="col-md-6">
              <label for="parentPhone" class="form-label">Parent/Guardian Phone</label>
              <input type="tel" class="form-control" id="parentPhone" name="parent_phone">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor" class="me-1">
              <use href="#icon-plus"></use>
            </svg>
            Add Student
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewStudentModalLabel">Student Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-md-4">
            <div class="text-center">
              <svg class="user-avatar-large text-muted mb-3" width="64" height="64" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <h5 class="fw-bold">John Doe</h5>
              <p class="text-muted">Grade 10-A</p>
              <span class="badge bg-success-subtle text-success">Active</span>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <p class="mb-0">john.doe@email.com</p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">LRN</label>
                <p class="mb-0"><code>123456789012</code></p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Birth Date</label>
                <p class="mb-0">January 15, 2008</p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Phone</label>
                <p class="mb-0">+63 912 345 6789</p>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Address</label>
                <p class="mb-0">123 Main Street, Barangay Example, City, Province</p>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Parent/Guardian</label>
                <p class="mb-0">Jane Doe - jane.doe@email.com - +63 912 345 6788</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Edit Student</button>
      </div>
    </div>
  </div>
</div>

<script>
// Form validation and submission
document.getElementById('addStudentForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  // Basic validation
  const form = this;
  const inputs = form.querySelectorAll('input[required], select[required]');
  let isValid = true;
  
  inputs.forEach(input => {
    if (!input.value.trim()) {
      input.classList.add('is-invalid');
      isValid = false;
    } else {
      input.classList.remove('is-invalid');
    }
  });
  
  // Email validation
  const email = document.getElementById('email');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email.value && !emailRegex.test(email.value)) {
    email.classList.add('is-invalid');
    isValid = false;
  }
  
  if (isValid) {
    console.log('Form is valid, submitting...');
    
    // Show success message
    const modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
    modal.hide();
    
    showAlert('Student added successfully!', 'success');
    
    // Reset form
    form.reset();
  }
});

// Select all functionality
document.getElementById('selectAll').addEventListener('change', function() {
  const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
  checkboxes.forEach(checkbox => {
    checkbox.checked = this.checked;
  });
  updateBulkActions();
});

// Individual checkbox change
document.querySelectorAll('tbody input[type="checkbox"]').forEach(checkbox => {
  checkbox.addEventListener('change', updateBulkActions);
});

function updateBulkActions() {
  const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
  const bulkEditBtn = document.getElementById('bulkEditBtn');
  const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
  
  if (checkedBoxes.length > 0) {
    bulkEditBtn.disabled = false;
    bulkDeleteBtn.disabled = false;
  } else {
    bulkEditBtn.disabled = true;
    bulkDeleteBtn.disabled = true;
  }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
  const searchTerm = this.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    if (text.includes(searchTerm)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});

// Filter functionality
document.getElementById('gradeFilter').addEventListener('change', function() {
  const selectedGrade = this.value;
  console.log('Filtering by grade:', selectedGrade);
  // Here you would filter the student data
});

document.getElementById('sectionFilter').addEventListener('change', function() {
  const selectedSection = this.value;
  console.log('Filtering by section:', selectedSection);
  // Here you would filter the student data
});

function showAlert(message, type) {
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
  alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
  alertDiv.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  `;
  
  document.body.appendChild(alertDiv);
  
  // Auto remove after 5 seconds
  setTimeout(() => {
    if (alertDiv.parentNode) {
      alertDiv.remove();
    }
  }, 5000);
}

// Demo loading swap for skeleton -> real data (replace when backend wiring is ready)
document.addEventListener('DOMContentLoaded', function(){
  const sk = document.getElementById('studentsSkeleton');
  const body = document.getElementById('studentsBody');
  if (sk && body) {
    setTimeout(() => {
      sk.style.display = 'none';
      body.style.display = '';
    }, 750);
  }
});
</script>
