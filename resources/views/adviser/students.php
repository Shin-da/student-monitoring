<?php
$title = 'Student Management';
?>

<!-- Student Management Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Student Management</h1>
      <p class="text-muted mb-0">Manage your advisory class students</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkActionsModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        Bulk Actions
      </button>
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Add Student
      </button>
    </div>
  </div>
</div>

<!-- Student Statistics -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-students"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="32">0</div>
          <div class="text-muted small">Total Students</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="28">0</div>
          <div class="text-muted small">Present Today</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="5">0</div>
          <div class="text-muted small">Need Attention</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="87.5" data-count-decimals="1">0</div>
          <div class="text-muted small">Class Average</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Filters and Search -->
<div class="surface mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Search Students</label>
      <div class="input-group">
        <span class="input-group-text">
          <svg class="icon" width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="Search by name, LRN..." id="studentSearch">
      </div>
    </div>
    <div class="col-md-2">
      <label class="form-label">Status</label>
      <select class="form-select" id="statusFilter">
        <option value="">All Status</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
        <option value="transferred">Transferred</option>
      </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Performance</label>
      <select class="form-select" id="performanceFilter">
        <option value="">All Performance</option>
        <option value="excellent">Excellent (90+)</option>
        <option value="good">Good (80-89)</option>
        <option value="average">Average (70-79)</option>
        <option value="needs-improvement">Needs Improvement (<70)</option>
      </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Attendance</label>
      <select class="form-select" id="attendanceFilter">
        <option value="">All Attendance</option>
        <option value="excellent">Excellent (95%+)</option>
        <option value="good">Good (90-94%)</option>
        <option value="poor">Poor (<90%)</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Actions</label>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="clearFilters()">
          <svg class="icon me-1" width="14" height="14" fill="currentColor">
            <use href="#icon-refresh"></use>
          </svg>
          Clear
        </button>
        <button class="btn btn-outline-primary btn-sm" onclick="exportStudents()">
          <svg class="icon me-1" width="14" height="14" fill="currentColor">
            <use href="#icon-download"></use>
          </svg>
          Export
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Students Table -->
<div class="surface">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Advisory Class Students</h5>
    <div class="d-flex align-items-center gap-2">
      <span class="text-muted small">32 students</span>
      <div class="btn-group" role="group">
        <input type="radio" class="btn-check" name="viewMode" id="tableView" checked>
        <label class="btn btn-outline-primary btn-sm" for="tableView">
          <svg class="icon" width="14" height="14" fill="currentColor">
            <use href="#icon-list"></use>
          </svg>
        </label>
        <input type="radio" class="btn-check" name="viewMode" id="cardView">
        <label class="btn btn-outline-primary btn-sm" for="cardView">
          <svg class="icon" width="14" height="14" fill="currentColor">
            <use href="#icon-grid"></use>
          </svg>
        </label>
      </div>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr>
          <th>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="selectAll">
              <label class="form-check-label" for="selectAll">Select All</label>
            </div>
          </th>
          <th>Student</th>
          <th>LRN</th>
          <th>Performance</th>
          <th>Attendance</th>
          <th>Status</th>
          <th>Last Activity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="studentsTableBody">
        <tr>
          <td>
            <div class="form-check">
              <input class="form-check-input student-checkbox" type="checkbox" value="1">
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Maria Santos</div>
                <div class="text-muted small">Grade 10 - Einstein</div>
              </div>
            </div>
          </td>
          <td>123456789012</td>
          <td>
            <div class="d-flex align-items-center">
              <div class="progress me-2" style="width: 60px; height: 8px;">
                <div class="progress-bar bg-success" style="width: 95%"></div>
              </div>
              <span class="fw-semibold text-success">95.2</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="progress me-2" style="width: 60px; height: 8px;">
                <div class="progress-bar bg-success" style="width: 98%"></div>
              </div>
              <span class="fw-semibold text-success">98%</span>
            </div>
          </td>
          <td><span class="badge bg-success">Active</span></td>
          <td>
            <div class="text-muted small">
              <div>Grade updated</div>
              <div>2 hours ago</div>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudent(1)">View Profile</a></li>
                <li><a class="dropdown-item" href="#" onclick="editStudent(1)">Edit Info</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewGrades(1)">View Grades</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewAttendance(1)">View Attendance</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(1)">Contact Parent</a></li>
                <li><a class="dropdown-item" href="#" onclick="createAlert(1)">Create Alert</a></li>
              </ul>
            </div>
          </td>
        </tr>
        
        <tr>
          <td>
            <div class="form-check">
              <input class="form-check-input student-checkbox" type="checkbox" value="2">
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Michael Torres</div>
                <div class="text-muted small">Grade 10 - Einstein</div>
              </div>
            </div>
          </td>
          <td>123456789013</td>
          <td>
            <div class="d-flex align-items-center">
              <div class="progress me-2" style="width: 60px; height: 8px;">
                <div class="progress-bar bg-warning" style="width: 75%"></div>
              </div>
              <span class="fw-semibold text-warning">75.2</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="progress me-2" style="width: 60px; height: 8px;">
                <div class="progress-bar bg-danger" style="width: 85%"></div>
              </div>
              <span class="fw-semibold text-danger">85%</span>
            </div>
          </td>
          <td><span class="badge bg-warning">Needs Attention</span></td>
          <td>
            <div class="text-muted small">
              <div>Absent 3 days</div>
              <div>4 hours ago</div>
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudent(2)">View Profile</a></li>
                <li><a class="dropdown-item" href="#" onclick="editStudent(2)">Edit Info</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewGrades(2)">View Grades</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewAttendance(2)">View Attendance</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(2)">Contact Parent</a></li>
                <li><a class="dropdown-item" href="#" onclick="createAlert(2)">Create Alert</a></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <!-- Pagination -->
  <nav aria-label="Students pagination" class="mt-4">
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

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Student to Advisory Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="addStudentForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Student Name</label>
              <input type="text" class="form-control" placeholder="Enter student name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">LRN</label>
              <input type="text" class="form-control" placeholder="Enter LRN" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade Level</label>
              <select class="form-select" required>
                <option value="">Select Grade</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Section</label>
              <select class="form-select" required>
                <option value="">Select Section</option>
                <option value="einstein">Einstein</option>
                <option value="newton">Newton</option>
                <option value="darwin">Darwin</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Notes</label>
              <textarea class="form-control" rows="3" placeholder="Any additional notes about the student..."></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="addStudent()">Add Student</button>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Actions Modal -->
<div class="modal fade" id="bulkActionsModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bulk Actions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="bulkActionsForm">
          <div class="mb-3">
            <label class="form-label">Selected Students: <span id="selectedCount">0</span></label>
          </div>
          <div class="mb-3">
            <label class="form-label">Action</label>
            <select class="form-select" required>
              <option value="">Select Action</option>
              <option value="message">Send Message</option>
              <option value="alert">Create Alert</option>
              <option value="meeting">Schedule Meeting</option>
              <option value="report">Generate Report</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Message (if applicable)</label>
            <textarea class="form-control" rows="3" placeholder="Enter message for selected students..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="executeBulkAction()">Execute Action</button>
      </div>
    </div>
  </div>
</div>

<script>
// Student Management System
class StudentManagement {
  constructor() {
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadStudentsData();
  }

  bindEvents() {
    // Search functionality
    document.getElementById('studentSearch').addEventListener('input', (e) => {
      this.searchStudents(e.target.value);
    });

    // Filter changes
    document.getElementById('statusFilter').addEventListener('change', () => this.filterStudents());
    document.getElementById('performanceFilter').addEventListener('change', () => this.filterStudents());
    document.getElementById('attendanceFilter').addEventListener('change', () => this.filterStudents());

    // Select all checkbox
    document.getElementById('selectAll').addEventListener('change', (e) => {
      this.toggleSelectAll(e.target.checked);
    });

    // Individual checkboxes
    document.querySelectorAll('.student-checkbox').forEach(checkbox => {
      checkbox.addEventListener('change', () => this.updateSelectedCount());
    });

    // View mode toggle
    document.querySelectorAll('input[name="viewMode"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.changeViewMode(e.target.value);
      });
    });
  }

  loadStudentsData() {
    console.log('Loading students data...');
    // Load students from API
  }

  searchStudents(searchTerm) {
    const rows = document.querySelectorAll('#studentsTableBody tr');
    rows.forEach(row => {
      const name = row.querySelector('.fw-semibold').textContent.toLowerCase();
      const lrn = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
      
      if (name.includes(searchTerm.toLowerCase()) || lrn.includes(searchTerm.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  filterStudents() {
    const status = document.getElementById('statusFilter').value;
    const performance = document.getElementById('performanceFilter').value;
    const attendance = document.getElementById('attendanceFilter').value;

    console.log(`Filtering by: Status=${status}, Performance=${performance}, Attendance=${attendance}`);
    // Implement filtering logic
  }

  toggleSelectAll(checked) {
    document.querySelectorAll('.student-checkbox').forEach(checkbox => {
      checkbox.checked = checked;
    });
    this.updateSelectedCount();
  }

  updateSelectedCount() {
    const selected = document.querySelectorAll('.student-checkbox:checked').length;
    document.getElementById('selectedCount').textContent = selected;
  }

  changeViewMode(mode) {
    if (mode === 'cardView') {
      // Switch to card view
      console.log('Switching to card view');
    } else {
      // Switch to table view
      console.log('Switching to table view');
    }
  }
}

// Global functions
function viewStudent(studentId) {
  showNotification(`Viewing student ${studentId}...`, { type: 'info' });
}

function editStudent(studentId) {
  showNotification(`Editing student ${studentId}...`, { type: 'info' });
}

function viewGrades(studentId) {
  showNotification(`Viewing grades for student ${studentId}...`, { type: 'info' });
}

function viewAttendance(studentId) {
  showNotification(`Viewing attendance for student ${studentId}...`, { type: 'info' });
}

function contactParent(studentId) {
  showNotification(`Contacting parent for student ${studentId}...`, { type: 'info' });
}

function createAlert(studentId) {
  showNotification(`Creating alert for student ${studentId}...`, { type: 'info' });
}

function addStudent() {
  showNotification('Student added successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
  modal.hide();
}

function executeBulkAction() {
  const selectedCount = document.getElementById('selectedCount').textContent;
  showNotification(`Executing bulk action for ${selectedCount} students...`, { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkActionsModal'));
  modal.hide();
}

function clearFilters() {
  document.getElementById('studentSearch').value = '';
  document.getElementById('statusFilter').value = '';
  document.getElementById('performanceFilter').value = '';
  document.getElementById('attendanceFilter').value = '';
  
  // Show all rows
  document.querySelectorAll('#studentsTableBody tr').forEach(row => {
    row.style.display = '';
  });
  
  showNotification('Filters cleared!', { type: 'success' });
}

function exportStudents() {
  showNotification('Exporting students data...', { type: 'info' });
  setTimeout(() => {
    showNotification('Export completed successfully!', { type: 'success' });
  }, 2000);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new StudentManagement();
});
</script>

<style>
/* Student Management Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.table-hover tbody tr:hover {
  background-color: var(--bs-table-hover-bg);
}

.progress {
  border-radius: 4px;
}

.progress-bar {
  border-radius: 4px;
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.badge {
  font-size: 0.75em;
}

.btn-check:checked + .btn {
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
  color: white;
}
</style>
