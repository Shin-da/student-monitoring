<!-- Interactive Components Demo Page -->
<div class="dashboard-header mb-4 position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); opacity: 0.1;"></div>
  <div class="position-relative">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 fw-bold mb-1 text-primary">Interactive Components Demo</h1>
        <p class="text-muted mb-0">Explore advanced UI components and interactions for the student monitoring system.</p>
        <div class="d-flex align-items-center gap-3 mt-2">
          <span class="badge bg-primary-subtle text-primary">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-star"></use>
            </svg>
            Frontend Showcase
          </span>
          <span class="badge bg-success-subtle text-success">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-chart"></use>
            </svg>
            Interactive Demo
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notification System Demo -->
<div class="row g-4 mb-4">
  <div class="col-12">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Notification System</h5>
      <p class="text-muted mb-4">Test different types of notifications and toast messages.</p>
      
      <div class="row g-3">
        <div class="col-md-3">
          <button class="btn btn-success w-100" onclick="notificationSystem.success('Operation completed successfully!', { title: 'Success', duration: 4000 })">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-check"></use>
            </svg>
            Success Notification
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-danger w-100" onclick="notificationSystem.error('Something went wrong! Please try again.', { title: 'Error', duration: 6000 })">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-alerts"></use>
            </svg>
            Error Notification
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-warning w-100" onclick="notificationSystem.warning('Please review your input before proceeding.', { title: 'Warning', duration: 5000 })">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-alerts"></use>
            </svg>
            Warning Notification
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-info w-100" onclick="notificationSystem.info('Here is some helpful information for you.', { title: 'Information', duration: 4000 })">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-chart"></use>
            </svg>
            Info Notification
          </button>
        </div>
      </div>
      
      <div class="row g-3 mt-3">
        <div class="col-md-4">
          <button class="btn btn-outline-primary w-100" onclick="testLoadingNotification()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-chart"></use>
            </svg>
            Loading Notification
          </button>
        </div>
        <div class="col-md-4">
          <button class="btn btn-outline-secondary w-100" onclick="testNotificationWithActions()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-user"></use>
            </svg>
            Notification with Actions
          </button>
        </div>
        <div class="col-md-4">
          <button class="btn btn-outline-danger w-100" onclick="notificationSystem.dismissAll()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-close"></use>
            </svg>
            Dismiss All
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Advanced Form Components Demo -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Advanced Form Components</h5>
      
      <form id="demoForm" novalidate>
        <div class="row g-3">
          <div class="col-12">
            <label for="demoDate" class="form-label">Date Picker</label>
            <input type="date" class="form-control" id="demoDate" name="date" required>
            <div class="invalid-feedback">Please select a valid date.</div>
          </div>
          
          <div class="col-12">
            <label for="demoTime" class="form-label">Time Picker</label>
            <input type="time" class="form-control" id="demoTime" name="time" required>
            <div class="invalid-feedback">Please select a valid time.</div>
          </div>
          
          <div class="col-12">
            <label for="demoFile" class="form-label">File Upload</label>
            <input type="file" class="form-control" id="demoFile" name="file" accept=".pdf,.doc,.docx,.jpg,.png" multiple>
            <div class="form-text">Accepted formats: PDF, DOC, DOCX, JPG, PNG</div>
          </div>
          
          <div class="col-12">
            <label for="demoRange" class="form-label">Range Slider</label>
            <input type="range" class="form-range" id="demoRange" name="range" min="0" max="100" value="50">
            <div class="d-flex justify-content-between">
              <small class="text-muted">0</small>
              <small class="text-muted">100</small>
            </div>
          </div>
          
          <div class="col-12">
            <label for="demoColor" class="form-label">Color Picker</label>
            <input type="color" class="form-control form-control-color" id="demoColor" name="color" value="#0d6efd">
          </div>
          
          <div class="col-12">
            <label for="demoTextarea" class="form-label">Rich Text Area</label>
            <textarea class="form-control" id="demoTextarea" name="textarea" rows="4" placeholder="Enter your message here..."></textarea>
            <div class="form-text">This could be enhanced with a rich text editor.</div>
          </div>
          
          <div class="col-12">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="demoSwitch" name="switch">
              <label class="form-check-label" for="demoSwitch">
                Enable notifications
              </label>
            </div>
          </div>
          
          <div class="col-12">
            <button type="submit" class="btn btn-primary">
              <svg width="16" height="16" fill="currentColor" class="me-2">
                <use href="#icon-check"></use>
              </svg>
              Submit Form
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Interactive Data Table</h5>
      
      <div class="mb-3">
        <div class="row g-2">
          <div class="col-md-6">
            <input type="text" class="form-control form-control-sm" id="tableSearch" placeholder="Search students...">
          </div>
          <div class="col-md-3">
            <select class="form-select form-select-sm" id="gradeFilter">
              <option value="">All Grades</option>
              <option value="9">Grade 9</option>
              <option value="10">Grade 10</option>
              <option value="11">Grade 11</option>
              <option value="12">Grade 12</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select form-select-sm" id="statusFilter">
              <option value="">All Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover" id="demoTable">
          <thead>
            <tr>
              <th style="cursor: pointer;" onclick="sortTable(0)">
                Name <svg width="12" height="12" fill="currentColor"><use href="#icon-chart"></use></svg>
              </th>
              <th style="cursor: pointer;" onclick="sortTable(1)">
                Grade <svg width="12" height="12" fill="currentColor"><use href="#icon-chart"></use></svg>
              </th>
              <th style="cursor: pointer;" onclick="sortTable(2)">
                Average <svg width="12" height="12" fill="currentColor"><use href="#icon-chart"></use></svg>
              </th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John Michael Doe</td>
              <td>10</td>
              <td>85.2</td>
              <td><span class="badge bg-success-subtle text-success">Active</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary" onclick="viewStudent(1)">View</button>
                <button class="btn btn-sm btn-outline-secondary" onclick="editStudent(1)">Edit</button>
              </td>
            </tr>
            <tr>
              <td>Sarah Jane Smith</td>
              <td>9</td>
              <td>92.5</td>
              <td><span class="badge bg-success-subtle text-success">Active</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary" onclick="viewStudent(2)">View</button>
                <button class="btn btn-sm btn-outline-secondary" onclick="editStudent(2)">Edit</button>
              </td>
            </tr>
            <tr>
              <td>Michael Johnson</td>
              <td>11</td>
              <td>78.9</td>
              <td><span class="badge bg-warning-subtle text-warning">Inactive</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary" onclick="viewStudent(3)">View</button>
                <button class="btn btn-sm btn-outline-secondary" onclick="editStudent(3)">Edit</button>
              </td>
            </tr>
            <tr>
              <td>Emily Rodriguez</td>
              <td>10</td>
              <td>88.7</td>
              <td><span class="badge bg-success-subtle text-success">Active</span></td>
              <td>
                <button class="btn btn-sm btn-outline-primary" onclick="viewStudent(4)">View</button>
                <button class="btn btn-sm btn-outline-secondary" onclick="editStudent(4)">Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Chart Components Demo -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Data Visualization</h5>
      <div class="row g-3 mb-3">
        <div class="col-md-4">
          <button class="btn btn-outline-primary btn-sm w-100" onclick="updateChart('line')">Line Chart</button>
        </div>
        <div class="col-md-4">
          <button class="btn btn-outline-primary btn-sm w-100" onclick="updateChart('bar')">Bar Chart</button>
        </div>
        <div class="col-md-4">
          <button class="btn btn-outline-primary btn-sm w-100" onclick="updateChart('doughnut')">Doughnut Chart</button>
        </div>
      </div>
      <canvas id="demoChart" height="100"></canvas>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Progress Indicators</h5>
      
      <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span class="small fw-semibold">Overall Progress</span>
          <span class="small text-muted">85%</span>
        </div>
        <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-primary" style="width: 85%" data-progress-to="85"></div>
        </div>
      </div>
      
      <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span class="small fw-semibold">Mathematics</span>
          <span class="small text-muted">92%</span>
        </div>
        <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-success" style="width: 92%" data-progress-to="92"></div>
        </div>
      </div>
      
      <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span class="small fw-semibold">Science</span>
          <span class="small text-muted">78%</span>
        </div>
        <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-warning" style="width: 78%" data-progress-to="78"></div>
        </div>
      </div>
      
      <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span class="small fw-semibold">English</span>
          <span class="small text-muted">65%</span>
        </div>
        <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-danger" style="width: 65%" data-progress-to="65"></div>
        </div>
      </div>
      
      <button class="btn btn-outline-primary btn-sm w-100" onclick="animateProgressBars()">
        <svg width="16" height="16" fill="currentColor" class="me-2">
          <use href="#icon-chart"></use>
        </svg>
        Animate Progress
      </button>
    </div>
  </div>
</div>

<!-- Modal Components Demo -->
<div class="row g-4">
  <div class="col-12">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Modal Components</h5>
      <p class="text-muted mb-4">Test different types of modal dialogs and overlays.</p>
      
      <div class="row g-3">
        <div class="col-md-3">
          <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#infoModal">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-chart"></use>
            </svg>
            Info Modal
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#confirmModal">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-alerts"></use>
            </svg>
            Confirm Modal
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-delete"></use>
            </svg>
            Delete Modal
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-info w-100" onclick="showCustomModal()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-plus"></use>
            </svg>
            Custom Modal
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="stat-icon bg-info-subtle text-info" style="width: 40px; height: 40px;">
            <svg width="20" height="20" fill="currentColor">
              <use href="#icon-chart"></use>
            </svg>
          </div>
          <div>
            <h6 class="mb-1">System Information</h6>
            <p class="text-muted small mb-0">Here's some important information about the system.</p>
          </div>
        </div>
        <p>This is a demo modal showing how information can be displayed to users in a clean and organized way.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Learn More</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="stat-icon bg-warning-subtle text-warning" style="width: 40px; height: 40px;">
            <svg width="20" height="20" fill="currentColor">
              <use href="#icon-alerts"></use>
            </svg>
          </div>
          <div>
            <h6 class="mb-1">Are you sure?</h6>
            <p class="text-muted small mb-0">This action cannot be undone.</p>
          </div>
        </div>
        <p>Please confirm that you want to proceed with this action. This will make changes to the system.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-warning" onclick="confirmAction()">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="stat-icon bg-danger-subtle text-danger" style="width: 40px; height: 40px;">
            <svg width="20" height="20" fill="currentColor">
              <use href="#icon-delete"></use>
            </svg>
          </div>
          <div>
            <h6 class="mb-1">Permanent Deletion</h6>
            <p class="text-muted small mb-0">This action is irreversible.</p>
          </div>
        </div>
        <p>Are you sure you want to delete this item? This action cannot be undone and all associated data will be permanently removed.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= \Helpers\Url::asset('notification-system.js') ?>"></script>
<script>
// Demo functionality
let demoChart = null;
let loadingNotificationId = null;

// Initialize demo chart
document.addEventListener('DOMContentLoaded', function() {
    initDemoChart();
    initTableFiltering();
    initFormValidation();
});

function initDemoChart() {
    const ctx = document.getElementById('demoChart');
    if (!ctx) return;
    
    demoChart = new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Student Performance',
                data: [65, 72, 78, 85, 82, 88],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
}

function updateChart(type) {
    if (!demoChart) return;
    
    const data = {
        line: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Student Performance',
                data: [65, 72, 78, 85, 82, 88],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        bar: {
            labels: ['Math', 'Science', 'English', 'Filipino', 'History'],
            datasets: [{
                label: 'Subject Averages',
                data: [85, 92, 78, 88, 82],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#0dcaf0', '#6f42c1'],
                borderWidth: 0
            }]
        },
        doughnut: {
            labels: ['Passed', 'Failed', 'Incomplete'],
            datasets: [{
                data: [75, 15, 10],
                backgroundColor: ['#198754', '#dc3545', '#ffc107'],
                borderWidth: 0
            }]
        }
    };
    
    demoChart.config.type = type;
    demoChart.data = data[type];
    demoChart.update();
    
    notificationSystem.info(`Chart updated to ${type} view`);
}

function testLoadingNotification() {
    loadingNotificationId = notificationSystem.loading('Processing your request...', { title: 'Loading' });
    
    setTimeout(() => {
        notificationSystem.updateLoading(loadingNotificationId, 'Request completed successfully!', 'success');
    }, 3000);
}

function testNotificationWithActions() {
    notificationSystem.show('You have unsaved changes. What would you like to do?', {
        title: 'Unsaved Changes',
        type: 'warning',
        duration: 0,
        actions: [
            {
                text: 'Save',
                primary: true,
                handler: 'saveChanges'
            },
            {
                text: 'Discard',
                primary: false,
                handler: 'discardChanges'
            }
        ]
    });
}

function saveChanges(id) {
    notificationSystem.dismiss(id);
    notificationSystem.success('Changes saved successfully!');
}

function discardChanges(id) {
    notificationSystem.dismiss(id);
    notificationSystem.warning('Changes discarded');
}

function initTableFiltering() {
    const searchInput = document.getElementById('tableSearch');
    const gradeFilter = document.getElementById('gradeFilter');
    const statusFilter = document.getElementById('statusFilter');
    const table = document.getElementById('demoTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const gradeValue = gradeFilter.value;
        const statusValue = statusFilter.value;
        
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const name = row.cells[0].textContent.toLowerCase();
            const grade = row.cells[1].textContent;
            const status = row.cells[3].textContent.toLowerCase();
            
            const matchesSearch = name.includes(searchTerm);
            const matchesGrade = !gradeValue || grade === gradeValue;
            const matchesStatus = !statusValue || status.includes(statusValue);
            
            row.style.display = (matchesSearch && matchesGrade && matchesStatus) ? '' : 'none';
        }
    }
    
    searchInput.addEventListener('input', filterTable);
    gradeFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);
}

function sortTable(columnIndex) {
    const table = document.getElementById('demoTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));
    
    const isNumeric = columnIndex === 1 || columnIndex === 2; // Grade and Average columns
    
    rows.sort((a, b) => {
        const aValue = a.cells[columnIndex].textContent.trim();
        const bValue = b.cells[columnIndex].textContent.trim();
        
        if (isNumeric) {
            return parseFloat(aValue) - parseFloat(bValue);
        } else {
            return aValue.localeCompare(bValue);
        }
    });
    
    rows.forEach(row => tbody.appendChild(row));
    notificationSystem.info('Table sorted successfully');
}

function viewStudent(id) {
    notificationSystem.info(`Viewing student with ID: ${id}`);
}

function editStudent(id) {
    notificationSystem.warning(`Editing student with ID: ${id}`);
}

function initFormValidation() {
    const form = document.getElementById('demoForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });
        
        if (isValid) {
            notificationSystem.success('Form submitted successfully!');
            form.reset();
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
        } else {
            notificationSystem.error('Please fill in all required fields.');
        }
    });
}

function animateProgressBars() {
    const progressBars = document.querySelectorAll('[data-progress-to]');
    
    progressBars.forEach(bar => {
        const target = parseFloat(bar.getAttribute('data-progress-to'));
        const duration = 2000;
        const start = performance.now();
        
        function updateProgress(currentTime) {
            const elapsed = currentTime - start;
            const progress = Math.min(elapsed / duration, 1);
            const current = progress * target;
            
            bar.style.width = current + '%';
            
            if (progress < 1) {
                requestAnimationFrame(updateProgress);
            }
        }
        
        bar.style.width = '0%';
        requestAnimationFrame(updateProgress);
    });
    
    notificationSystem.info('Progress bars animated');
}

function confirmAction() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
    modal.hide();
    notificationSystem.success('Action confirmed and executed!');
}

function deleteItem() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
    modal.hide();
    notificationSystem.error('Item deleted successfully!');
}

function showCustomModal() {
    // Create a custom modal dynamically
    const modalHtml = `
        <div class="modal fade" id="customModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Custom Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="surface p-3">
                                    <h6>Feature 1</h6>
                                    <p class="text-muted small">This is a custom modal with dynamic content.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="surface p-3">
                                    <h6>Feature 2</h6>
                                    <p class="text-muted small">It can contain any HTML content you need.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="customModalAction()">Action</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing custom modal if any
    const existingModal = document.getElementById('customModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add new modal to body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('customModal'));
    modal.show();
    
    // Clean up when hidden
    document.getElementById('customModal').addEventListener('hidden.bs.modal', function() {
        this.remove();
    });
}

function customModalAction() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('customModal'));
    modal.hide();
    notificationSystem.success('Custom modal action executed!');
}
</script>
