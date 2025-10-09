<?php
$title = 'Student Performance';
?>

<!-- Performance Tracking Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Student Performance Tracking</h1>
      <p class="text-muted mb-0">Monitor and analyze student academic performance</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#performanceReportModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        Generate Report
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#interventionModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Create Intervention
      </button>
    </div>
  </div>
</div>

<!-- Performance Overview Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="18">0</div>
          <div class="text-muted small">Excellent (90+)</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="10">0</div>
          <div class="text-muted small">Good (80-89)</div>
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
          <div class="h4 fw-bold text-warning mb-0" data-count-to="3">0</div>
          <div class="text-muted small">Average (70-79)</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-danger bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-danger" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-danger mb-0" data-count-to="1">0</div>
          <div class="text-muted small">Needs Help (<70)</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Performance Analytics -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Performance Trends</h5>
        <div class="btn-group" role="group">
          <input type="radio" class="btn-check" name="trendView" id="quarterly" checked>
          <label class="btn btn-outline-primary btn-sm" for="quarterly">Quarterly</label>
          <input type="radio" class="btn-check" name="trendView" id="monthly">
          <label class="btn btn-outline-primary btn-sm" for="monthly">Monthly</label>
          <input type="radio" class="btn-check" name="trendView" id="weekly">
          <label class="btn btn-outline-primary btn-sm" for="weekly">Weekly</label>
        </div>
      </div>
      
      <div class="position-relative" style="height: 350px;">
        <canvas id="performanceTrendChart"></canvas>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface">
      <h5 class="mb-4">Subject Performance</h5>
      <div class="position-relative" style="height: 350px;">
        <canvas id="subjectPerformanceChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Performance Filters -->
<div class="surface mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Student</label>
      <select class="form-select" id="studentFilter">
        <option value="">All Students</option>
        <option value="1">Maria Santos</option>
        <option value="2">John Cruz</option>
        <option value="3">Ana Garcia</option>
        <option value="4">Michael Torres</option>
        <option value="5">Sarah Lee</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Subject</label>
      <select class="form-select" id="subjectFilter">
        <option value="">All Subjects</option>
        <option value="mathematics">Mathematics</option>
        <option value="science">Science</option>
        <option value="english">English</option>
        <option value="filipino">Filipino</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Quarter</label>
      <select class="form-select" id="quarterFilter">
        <option value="">All Quarters</option>
        <option value="1">1st Quarter</option>
        <option value="2">2nd Quarter</option>
        <option value="3">3rd Quarter</option>
        <option value="4">4th Quarter</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Actions</label>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="clearPerformanceFilters()">
          <svg class="icon me-1" width="14" height="14" fill="currentColor">
            <use href="#icon-refresh"></use>
          </svg>
          Clear
        </button>
        <button class="btn btn-outline-primary btn-sm" onclick="exportPerformance()">
          <svg class="icon me-1" width="14" height="14" fill="currentColor">
            <use href="#icon-download"></use>
          </svg>
          Export
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Performance Table -->
<div class="surface">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Student Performance Details</h5>
    <div class="d-flex align-items-center gap-2">
      <span class="text-muted small">32 students</span>
      <div class="btn-group" role="group">
        <input type="radio" class="btn-check" name="performanceView" id="overview" checked>
        <label class="btn btn-outline-primary btn-sm" for="overview">Overview</label>
        <input type="radio" class="btn-check" name="performanceView" id="detailed">
        <label class="btn btn-outline-primary btn-sm" for="detailed">Detailed</label>
      </div>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr>
          <th>Student</th>
          <th>Overall Average</th>
          <th>Mathematics</th>
          <th>Science</th>
          <th>English</th>
          <th>Filipino</th>
          <th>Trend</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-success" width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Maria Santos</div>
                <div class="text-muted small">Grade 10 - Einstein</div>
              </div>
            </div>
          </td>
          <td>
            <div class="fw-bold text-success">95.2</div>
            <div class="text-muted small">Excellent</div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success">96.5</span>
              <svg class="icon text-success ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success">94.8</span>
              <svg class="icon text-success ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success">95.1</span>
              <svg class="icon text-success ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success">94.4</span>
              <svg class="icon text-success ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <svg class="icon text-success" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
              <span class="text-success small ms-1">+2.3%</span>
            </div>
          </td>
          <td><span class="badge bg-success">Excellent</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudentPerformance(1)">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="createIntervention(1)">Create Intervention</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(1)">Contact Parent</a></li>
                <li><a class="dropdown-item" href="#" onclick="generateReport(1)">Generate Report</a></li>
              </ul>
            </div>
          </td>
        </tr>
        
        <tr>
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
          <td>
            <div class="fw-bold text-warning">75.2</div>
            <div class="text-muted small">Average</div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning">78.5</span>
              <svg class="icon text-danger ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning">72.1</span>
              <svg class="icon text-danger ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning">76.8</span>
              <svg class="icon text-success ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning">73.4</span>
              <svg class="icon text-danger ms-1" width="14" height="14" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
              <span class="text-danger small ms-1">-1.8%</span>
            </div>
          </td>
          <td><span class="badge bg-warning">Needs Attention</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudentPerformance(2)">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="createIntervention(2)">Create Intervention</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(2)">Contact Parent</a></li>
                <li><a class="dropdown-item" href="#" onclick="generateReport(2)">Generate Report</a></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Performance Report Modal -->
<div class="modal fade" id="performanceReportModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generate Performance Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="performanceReportForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Report Type</label>
              <select class="form-select" required>
                <option value="">Select Report Type</option>
                <option value="individual">Individual Student</option>
                <option value="class">Class Performance</option>
                <option value="subject">Subject Analysis</option>
                <option value="comparative">Comparative Analysis</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Period</label>
              <select class="form-select" required>
                <option value="">Select Period</option>
                <option value="quarter1">1st Quarter</option>
                <option value="quarter2">2nd Quarter</option>
                <option value="quarter3">3rd Quarter</option>
                <option value="quarter4">4th Quarter</option>
                <option value="semester1">1st Semester</option>
                <option value="semester2">2nd Semester</option>
                <option value="yearly">Full Year</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Students</label>
              <select class="form-select" multiple size="4">
                <option value="all">All Students</option>
                <option value="1">Maria Santos</option>
                <option value="2">John Cruz</option>
                <option value="3">Ana Garcia</option>
                <option value="4">Michael Torres</option>
                <option value="5">Sarah Lee</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Format</label>
              <select class="form-select" required>
                <option value="pdf">PDF Document</option>
                <option value="excel">Excel Spreadsheet</option>
                <option value="csv">CSV File</option>
              </select>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="includeCharts" checked>
                <label class="form-check-label" for="includeCharts">
                  Include charts and visualizations
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="generatePerformanceReport()">Generate Report</button>
      </div>
    </div>
  </div>
</div>

<!-- Intervention Modal -->
<div class="modal fade" id="interventionModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Academic Intervention</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="interventionForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Student</label>
              <select class="form-select" required>
                <option value="">Select Student</option>
                <option value="1">Maria Santos</option>
                <option value="2">John Cruz</option>
                <option value="3">Ana Garcia</option>
                <option value="4">Michael Torres</option>
                <option value="5">Sarah Lee</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="">Select Subject</option>
                <option value="mathematics">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
                <option value="filipino">Filipino</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Intervention Type</label>
              <select class="form-select" required>
                <option value="">Select Intervention Type</option>
                <option value="tutoring">Tutoring Session</option>
                <option value="remedial">Remedial Class</option>
                <option value="study-group">Study Group</option>
                <option value="parent-meeting">Parent Meeting</option>
                <option value="counseling">Academic Counseling</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="3" placeholder="Describe the intervention plan..." required></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Start Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">End Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Expected Outcome</label>
              <input type="text" class="form-control" placeholder="Describe expected improvement..." required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="createIntervention()">Create Intervention</button>
      </div>
    </div>
  </div>
</div>

<script>
// Performance Tracking System
class PerformanceTracking {
  constructor() {
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.loadPerformanceData();
  }

  initializeCharts() {
    // Performance Trend Chart
    const trendCtx = document.getElementById('performanceTrendChart');
    if (trendCtx) {
      new Chart(trendCtx, {
        type: 'line',
        data: {
          labels: ['Q1', 'Q2', 'Q3', 'Q4'],
          datasets: [{
            label: 'Class Average',
            data: [85.2, 87.1, 88.5, 87.5],
            borderColor: 'rgb(13, 110, 253)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
          }, {
            label: 'Top 25%',
            data: [92.1, 93.8, 94.2, 95.1],
            borderColor: 'rgb(25, 135, 84)',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            tension: 0.4,
            fill: true
          }, {
            label: 'Bottom 25%',
            data: [78.5, 79.2, 80.1, 79.8],
            borderColor: 'rgb(220, 53, 69)',
            backgroundColor: 'rgba(220, 53, 69, 0.1)',
            tension: 0.4,
            fill: true
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
            }
          },
          scales: {
            y: {
              beginAtZero: false,
              min: 70,
              max: 100
            }
          }
        }
      });
    }

    // Subject Performance Chart
    const subjectCtx = document.getElementById('subjectPerformanceChart');
    if (subjectCtx) {
      new Chart(subjectCtx, {
        type: 'bar',
        data: {
          labels: ['Mathematics', 'Science', 'English', 'Filipino'],
          datasets: [{
            label: 'Average Grade',
            data: [87.5, 89.2, 85.8, 88.1],
            backgroundColor: [
              'rgba(13, 110, 253, 0.8)',
              'rgba(25, 135, 84, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(220, 53, 69, 0.8)'
            ]
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
              beginAtZero: false,
              min: 80,
              max: 95
            }
          }
        }
      });
    }
  }

  bindEvents() {
    // Trend view toggle
    document.querySelectorAll('input[name="trendView"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.updateTrendView(e.target.value);
      });
    });

    // Performance view toggle
    document.querySelectorAll('input[name="performanceView"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.updatePerformanceView(e.target.value);
      });
    });

    // Filter changes
    document.getElementById('studentFilter').addEventListener('change', () => this.filterPerformance());
    document.getElementById('subjectFilter').addEventListener('change', () => this.filterPerformance());
    document.getElementById('quarterFilter').addEventListener('change', () => this.filterPerformance());
  }

  loadPerformanceData() {
    console.log('Loading performance data...');
    // Load performance data from API
  }

  updateTrendView(view) {
    console.log(`Updating trend view to: ${view}`);
    // Update charts based on selected view
  }

  updatePerformanceView(view) {
    console.log(`Updating performance view to: ${view}`);
    // Update table view
  }

  filterPerformance() {
    const student = document.getElementById('studentFilter').value;
    const subject = document.getElementById('subjectFilter').value;
    const quarter = document.getElementById('quarterFilter').value;

    console.log(`Filtering by: Student=${student}, Subject=${subject}, Quarter=${quarter}`);
    // Implement filtering logic
  }
}

// Global functions
function viewStudentPerformance(studentId) {
  showNotification(`Viewing performance details for student ${studentId}...`, { type: 'info' });
}

function createIntervention(studentId) {
  if (studentId) {
    showNotification(`Creating intervention for student ${studentId}...`, { type: 'info' });
  } else {
    showNotification('Intervention created successfully!', { type: 'success' });
    const modal = bootstrap.Modal.getInstance(document.getElementById('interventionModal'));
    modal.hide();
  }
}

function contactParent(studentId) {
  showNotification(`Contacting parent for student ${studentId}...`, { type: 'info' });
}

function generateReport(studentId) {
  showNotification(`Generating report for student ${studentId}...`, { type: 'info' });
}

function generatePerformanceReport() {
  showNotification('Generating performance report...', { type: 'info' });
  setTimeout(() => {
    showNotification('Performance report generated successfully!', { type: 'success' });
  }, 2000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('performanceReportModal'));
  modal.hide();
}

function clearPerformanceFilters() {
  document.getElementById('studentFilter').value = '';
  document.getElementById('subjectFilter').value = '';
  document.getElementById('quarterFilter').value = '';
  
  showNotification('Performance filters cleared!', { type: 'success' });
}

function exportPerformance() {
  showNotification('Exporting performance data...', { type: 'info' });
  setTimeout(() => {
    showNotification('Performance data exported successfully!', { type: 'success' });
  }, 2000);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new PerformanceTracking();
});
</script>

<style>
/* Performance Tracking Specific Styles */
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
