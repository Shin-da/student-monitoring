<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Grade Management</h1>
      <p class="text-muted mb-0">Manage student grades and assessments</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-chart"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Filter</span>
      </button>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addGradeModal">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Add Grade</span>
      </button>
    </div>
  </div>
</div>

<!-- Grade Statistics Cards -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-primary-subtle text-primary">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <span class="badge bg-primary-subtle text-primary">+5%</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="1247">0</h3>
      <p class="text-muted small mb-0">Total Grades</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-success-subtle text-success">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-performance"></use>
          </svg>
        </div>
        <span class="badge bg-success-subtle text-success">85.2%</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="85.2" data-count-decimals="1">0.0</h3>
      <p class="text-muted small mb-0">Average Grade</p>
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
        <span class="badge bg-warning-subtle text-warning">12</span>
      </div>
      <h3 class="h4 fw-bold mb-1" data-count-to="12">0</h3>
      <p class="text-muted small mb-0">Failing Grades</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-info-subtle text-info">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
        </div>
        <span class="badge bg-info-subtle text-info">78%</span>
      </div>
      <h3 class="h4 fw-bold mb-1">+<span data-count-to="78" data-count-decimals="0">0</span>%</h3>
      <p class="text-muted small mb-0">Passing Rate</p>
    </div>
  </div>
</div>

<!-- Grade Management Table -->
<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Grade Records</h5>
    <div class="d-flex gap-2">
      <select class="form-select form-select-sm" style="width: auto;">
        <option value="">All Quarters</option>
        <option value="1">1st Quarter</option>
        <option value="2">2nd Quarter</option>
        <option value="3">3rd Quarter</option>
        <option value="4">4th Quarter</option>
      </select>
      <select class="form-select form-select-sm" style="width: auto;">
        <option value="">All Types</option>
        <option value="ww">Written Work</option>
        <option value="pt">Performance Task</option>
        <option value="qe">Quarterly Exam</option>
      </select>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Student</th>
          <th>Subject</th>
          <th>Grade Type</th>
          <th>Quarter</th>
          <th>Grade</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- Skeleton rows shown while loading -->
      <tbody id="gradesSkeleton">
        <tr>
          <td colspan="7">
            <div class="skeleton" style="height: 18px; width: 100%;"></div>
          </td>
        </tr>
        <tr>
          <td colspan="7">
            <div class="skeleton" style="height: 18px; width: 100%;"></div>
          </td>
        </tr>
        <tr>
          <td colspan="7">
            <div class="skeleton" style="height: 18px; width: 100%;"></div>
          </td>
        </tr>
      </tbody>
      <!-- Real data body -->
      <tbody id="gradesBody" style="display:none">
        <!-- Sample data - will be replaced with real data -->
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <span>John Doe</span>
            </div>
          </td>
          <td>Mathematics</td>
          <td><span class="badge bg-primary-subtle text-primary">WW</span></td>
          <td>1st</td>
          <td><span class="fw-bold text-success">85</span></td>
          <td>2024-01-15</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="Edit">
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
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <span>Jane Smith</span>
            </div>
          </td>
          <td>Science</td>
          <td><span class="badge bg-warning-subtle text-warning">PT</span></td>
          <td>1st</td>
          <td><span class="fw-bold text-success">92</span></td>
          <td>2024-01-16</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="Edit">
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
            <div class="d-flex align-items-center gap-2">
              <svg class="user-avatar" width="20" height="20" fill="currentColor">
                <use href="#icon-student"></use>
              </svg>
              <span>Mike Johnson</span>
            </div>
          </td>
          <td>English</td>
          <td><span class="badge bg-info-subtle text-info">QE</span></td>
          <td>1st</td>
          <td><span class="fw-bold text-danger">65</span></td>
          <td>2024-01-17</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-primary" title="Edit">
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
  
  <!-- Pagination -->
  <nav aria-label="Grade pagination" class="mt-4">
    <ul class="pagination justify-content-center">
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

<!-- Add Grade Modal -->
<div class="modal fade" id="addGradeModal" tabindex="-1" aria-labelledby="addGradeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGradeModalLabel">Add New Grade</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addGradeForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="studentSelect" class="form-label">Student <span class="text-danger">*</span></label>
              <select class="form-select" id="studentSelect" name="student_id" required>
                <option value="">Select Student</option>
                <option value="1">John Doe - Grade 10-A</option>
                <option value="2">Jane Smith - Grade 10-A</option>
                <option value="3">Mike Johnson - Grade 10-B</option>
                <option value="4">Sarah Wilson - Grade 10-B</option>
              </select>
              <div class="invalid-feedback">Please select a student.</div>
            </div>
            <div class="col-md-6">
              <label for="subjectSelect" class="form-label">Subject <span class="text-danger">*</span></label>
              <select class="form-select" id="subjectSelect" name="subject_id" required>
                <option value="">Select Subject</option>
                <option value="1">Mathematics</option>
                <option value="2">Science</option>
                <option value="3">English</option>
                <option value="4">Filipino</option>
                <option value="5">History</option>
              </select>
              <div class="invalid-feedback">Please select a subject.</div>
            </div>
            <div class="col-md-4">
              <label for="gradeType" class="form-label">Grade Type <span class="text-danger">*</span></label>
              <select class="form-select" id="gradeType" name="grade_type" required>
                <option value="">Select Type</option>
                <option value="ww">Written Work (WW)</option>
                <option value="pt">Performance Task (PT)</option>
                <option value="qe">Quarterly Exam (QE)</option>
              </select>
              <div class="invalid-feedback">Please select a grade type.</div>
            </div>
            <div class="col-md-4">
              <label for="quarter" class="form-label">Quarter <span class="text-danger">*</span></label>
              <select class="form-select" id="quarter" name="quarter" required>
                <option value="">Select Quarter</option>
                <option value="1">1st Quarter</option>
                <option value="2">2nd Quarter</option>
                <option value="3">3rd Quarter</option>
                <option value="4">4th Quarter</option>
              </select>
              <div class="invalid-feedback">Please select a quarter.</div>
            </div>
            <div class="col-md-4">
              <label for="gradeValue" class="form-label">Grade Value <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="gradeValue" name="grade_value" 
                     min="0" max="100" step="0.01" placeholder="0.00" required>
              <div class="invalid-feedback">Please enter a valid grade (0-100).</div>
            </div>
            <div class="col-12">
              <label for="remarks" class="form-label">Remarks (Optional)</label>
              <textarea class="form-control" id="remarks" name="remarks" rows="3" 
                        placeholder="Additional notes about this grade..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor" class="me-1">
              <use href="#icon-plus"></use>
            </svg>
            Add Grade
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter Grades</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="filterForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="filterStudent" class="form-label">Student</label>
              <select class="form-select" id="filterStudent" name="student_id">
                <option value="">All Students</option>
                <option value="1">John Doe</option>
                <option value="2">Jane Smith</option>
                <option value="3">Mike Johnson</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="filterSubject" class="form-label">Subject</label>
              <select class="form-select" id="filterSubject" name="subject_id">
                <option value="">All Subjects</option>
                <option value="1">Mathematics</option>
                <option value="2">Science</option>
                <option value="3">English</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="filterType" class="form-label">Grade Type</label>
              <select class="form-select" id="filterType" name="grade_type">
                <option value="">All Types</option>
                <option value="ww">Written Work</option>
                <option value="pt">Performance Task</option>
                <option value="qe">Quarterly Exam</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="filterQuarter" class="form-label">Quarter</label>
              <select class="form-select" id="filterQuarter" name="quarter">
                <option value="">All Quarters</option>
                <option value="1">1st Quarter</option>
                <option value="2">2nd Quarter</option>
                <option value="3">3rd Quarter</option>
                <option value="4">4th Quarter</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="filterDateFrom" class="form-label">Date From</label>
              <input type="date" class="form-control" id="filterDateFrom" name="date_from">
            </div>
            <div class="col-md-6">
              <label for="filterDateTo" class="form-label">Date To</label>
              <input type="date" class="form-control" id="filterDateTo" name="date_to">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-outline-primary" onclick="clearFilters()">Clear Filters</button>
          <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Form validation and submission
document.getElementById('addGradeForm').addEventListener('submit', function(e) {
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
  
  // Grade value validation
  const gradeValue = document.getElementById('gradeValue');
  const value = parseFloat(gradeValue.value);
  if (value < 0 || value > 100) {
    gradeValue.classList.add('is-invalid');
    isValid = false;
  }
  
  if (isValid) {
    // Here you would submit the form to the backend
    console.log('Form is valid, submitting...');
    
    // Show success message
    const modal = bootstrap.Modal.getInstance(document.getElementById('addGradeModal'));
    modal.hide();
    
    // Show success alert
    showAlert('Grade added successfully!', 'success');
    
    // Reset form
    form.reset();
  }
});

// Filter form submission
document.getElementById('filterForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  // Here you would apply the filters
  console.log('Applying filters...');
  
  const modal = bootstrap.Modal.getInstance(document.getElementById('filterModal'));
  modal.hide();
  
  showAlert('Filters applied successfully!', 'info');
});

function clearFilters() {
  document.getElementById('filterForm').reset();
}

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

// Demo loading: swap skeleton with real data (replace with real data events later)
document.addEventListener('DOMContentLoaded', function(){
  const skeleton = document.getElementById('gradesSkeleton');
  const body = document.getElementById('gradesBody');
  if (skeleton && body) {
    setTimeout(() => {
      skeleton.style.display = 'none';
      body.style.display = '';
    }, 700);
  }
});
</script>
