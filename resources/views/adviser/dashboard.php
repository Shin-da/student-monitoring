<?php
$title = 'Adviser Dashboard';
?>

<!-- Adviser Dashboard Header -->
<div class="dashboard-header">
<div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Class Adviser Dashboard</h1>
      <p class="text-muted mb-0">Manage your advisory class and track student progress</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#classReportModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        Generate Report
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactParentsModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-message"></use>
        </svg>
        Contact Parents
      </button>
    </div>
  </div>
</div>

<!-- Static Data Indicator -->
<?= $staticDataIndicator ?? '' ?>

<!-- Advisory Class Statistics -->
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
          <div class="h4 fw-bold text-primary mb-0" data-count-to="<?= $class_stats['total_students'] ?? 32 ?>">0</div>
          <div class="text-muted small">Total Students <?= \Helpers\StaticData::getStaticDataBadge() ?></div>
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
          <div class="text-muted small">Alerts</div>
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

<!-- Class Performance Overview -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Class Performance Overview</h5>
        <div class="btn-group" role="group">
          <input type="radio" class="btn-check" name="performanceView" id="quarterly" checked>
          <label class="btn btn-outline-primary btn-sm" for="quarterly">Quarterly</label>
          <input type="radio" class="btn-check" name="performanceView" id="monthly">
          <label class="btn btn-outline-primary btn-sm" for="monthly">Monthly</label>
          <input type="radio" class="btn-check" name="performanceView" id="weekly">
          <label class="btn btn-outline-primary btn-sm" for="weekly">Weekly</label>
        </div>
      </div>
      
      <div class="position-relative" style="height: 300px;">
        <canvas id="classPerformanceChart"></canvas>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface">
      <h5 class="mb-4">Grade Distribution</h5>
      <div class="position-relative" style="height: 300px;">
        <canvas id="gradeDistributionChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Student Performance & Alerts -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Top Performers</h5>
        <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
      </div>
      
      <div class="list-group list-group-flush">
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
              <svg class="icon text-success" width="16" height="16" fill="currentColor">
                <use href="#icon-star"></use>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Maria Santos</div>
              <div class="text-muted small">Grade 10 - Einstein</div>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-bold text-success">95.2</div>
            <div class="text-muted small">Average</div>
          </div>
        </div>
        
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
              <svg class="icon text-success" width="16" height="16" fill="currentColor">
                <use href="#icon-star"></use>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">John Cruz</div>
              <div class="text-muted small">Grade 10 - Einstein</div>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-bold text-success">92.8</div>
            <div class="text-muted small">Average</div>
          </div>
        </div>
        
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
              <svg class="icon text-success" width="16" height="16" fill="currentColor">
                <use href="#icon-star"></use>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Ana Garcia</div>
              <div class="text-muted small">Grade 10 - Einstein</div>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-bold text-success">91.5</div>
            <div class="text-muted small">Average</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Student Alerts</h5>
        <span class="badge bg-warning">5 Active</span>
      </div>
      
      <div class="list-group list-group-flush">
        <div class="list-group-item">
          <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-center">
              <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                  <use href="#icon-alerts"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Low Attendance</div>
                <div class="text-muted small">Michael Torres - 3 consecutive absences</div>
              </div>
            </div>
            <small class="text-muted">2 days ago</small>
          </div>
        </div>
        
        <div class="list-group-item">
          <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-center">
              <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                  <use href="#icon-alerts"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Failing Grade</div>
                <div class="text-muted small">Sarah Lee - Mathematics (75.2)</div>
              </div>
            </div>
            <small class="text-muted">1 day ago</small>
          </div>
        </div>
        
        <div class="list-group-item">
          <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-center">
              <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-info" width="16" height="16" fill="currentColor">
                  <use href="#icon-message"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Parent Request</div>
                <div class="text-muted small">Mrs. Rodriguez wants to schedule a meeting</div>
              </div>
            </div>
            <small class="text-muted">3 hours ago</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Activity & Quick Actions -->
<div class="row g-4">
  <div class="col-lg-8">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Recent Activity</h5>
        <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
      </div>
      
      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-marker bg-primary"></div>
          <div class="timeline-content">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="mb-1">Grade Updated</h6>
                <p class="text-muted mb-1">Mathematics grade for Maria Santos updated to 95.2</p>
                <small class="text-muted">2 hours ago</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="timeline-item">
          <div class="timeline-marker bg-warning"></div>
          <div class="timeline-content">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="mb-1">Attendance Alert</h6>
                <p class="text-muted mb-1">Michael Torres marked absent for 3rd consecutive day</p>
                <small class="text-muted">4 hours ago</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="timeline-item">
          <div class="timeline-marker bg-info"></div>
          <div class="timeline-content">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="mb-1">Parent Communication</h6>
                <p class="text-muted mb-1">Message sent to Mrs. Rodriguez about Sarah's progress</p>
                <small class="text-muted">1 day ago</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface">
      <h5 class="mb-4">Quick Actions</h5>
      
      <div class="d-grid gap-2">
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#takeAttendanceModal">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-calendar"></use>
          </svg>
          Take Attendance
        </button>
        
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#gradeEntryModal">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          Enter Grades
        </button>
        
        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#sendMessageModal">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-message"></use>
          </svg>
          Send Message
        </button>
        
        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#createAlertModal">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          Create Alert
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Class Report Modal -->
<div class="modal fade" id="classReportModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generate Class Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="classReportForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Report Type</label>
              <select class="form-select" required>
                <option value="">Select Report Type</option>
                <option value="performance">Performance Report</option>
                <option value="attendance">Attendance Report</option>
                <option value="behavior">Behavior Report</option>
                <option value="comprehensive">Comprehensive Report</option>
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
              <label class="form-label">Format</label>
              <select class="form-select" required>
                <option value="pdf">PDF Document</option>
                <option value="excel">Excel Spreadsheet</option>
                <option value="csv">CSV File</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Include Charts</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="includeCharts" checked>
                <label class="form-check-label" for="includeCharts">
                  Include visual charts and graphs
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="generateClassReport()">Generate Report</button>
      </div>
    </div>
  </div>
</div>

<!-- Contact Parents Modal -->
<div class="modal fade" id="contactParentsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contact Parents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="contactParentsForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Select Students</label>
              <select class="form-select" multiple size="5" required>
                <option value="all">All Students</option>
                <option value="1">Maria Santos</option>
                <option value="2">John Cruz</option>
                <option value="3">Ana Garcia</option>
                <option value="4">Michael Torres</option>
                <option value="5">Sarah Lee</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Communication Method</label>
              <select class="form-select" required>
                <option value="">Select Method</option>
                <option value="email">Email</option>
                <option value="sms">SMS</option>
                <option value="phone">Phone Call</option>
                <option value="meeting">Schedule Meeting</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Subject</label>
              <input type="text" class="form-control" placeholder="Enter message subject" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea class="form-control" rows="4" placeholder="Enter your message to parents..." required></textarea>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="urgentMessage">
                <label class="form-check-label" for="urgentMessage">
                  Mark as urgent
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="sendParentMessage()">Send Message</button>
      </div>
    </div>
  </div>
</div>

<script>
// Adviser Dashboard Management
class AdviserDashboard {
  constructor() {
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.loadDashboardData();
  }

  initializeCharts() {
    // Class Performance Chart
    const performanceCtx = document.getElementById('classPerformanceChart');
    if (performanceCtx) {
      new Chart(performanceCtx, {
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
            label: 'Top 10%',
            data: [92.1, 93.8, 94.2, 95.1],
            borderColor: 'rgb(25, 135, 84)',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
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
              min: 80,
              max: 100
            }
          }
        }
      });
    }

    // Grade Distribution Chart
    const distributionCtx = document.getElementById('gradeDistributionChart');
    if (distributionCtx) {
      new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['90-100', '80-89', '70-79', '60-69', 'Below 60'],
          datasets: [{
            data: [12, 15, 3, 2, 0],
            backgroundColor: [
              'rgb(25, 135, 84)',
              'rgb(13, 110, 253)',
              'rgb(255, 193, 7)',
              'rgb(220, 53, 69)',
              'rgb(108, 117, 125)'
            ]
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
            }
          }
        }
      });
    }
  }

  bindEvents() {
    // Performance view toggle
    document.querySelectorAll('input[name="performanceView"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.updatePerformanceView(e.target.value);
      });
    });
  }

  loadDashboardData() {
    console.log('Loading adviser dashboard data...');
    // Load real data from API
  }

  updatePerformanceView(view) {
    console.log(`Updating performance view to: ${view}`);
    // Update charts based on selected view
  }
}

// Global functions
function generateClassReport() {
  showNotification('Generating class report...', { type: 'info' });
  setTimeout(() => {
    showNotification('Class report generated successfully!', { type: 'success' });
  }, 2000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('classReportModal'));
  modal.hide();
}

function sendParentMessage() {
  showNotification('Sending message to parents...', { type: 'info' });
  setTimeout(() => {
    showNotification('Message sent successfully!', { type: 'success' });
  }, 1500);
  const modal = bootstrap.Modal.getInstance(document.getElementById('contactParentsModal'));
  modal.hide();
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new AdviserDashboard();
});
</script>

<style>
/* Adviser Dashboard Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.timeline {
  position: relative;
  padding-left: 2rem;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 0.75rem;
  top: 0;
  bottom: 0;
  width: 2px;
  background: var(--bs-border-color);
}

.timeline-item {
  position: relative;
  margin-bottom: 1.5rem;
}

.timeline-marker {
  position: absolute;
  left: -2rem;
  top: 0.5rem;
  width: 0.75rem;
  height: 0.75rem;
  border-radius: 50%;
  border: 2px solid white;
  box-shadow: 0 0 0 2px currentColor;
}

.timeline-content {
  background: var(--bs-body-bg);
  padding: 1rem;
  border-radius: 0.5rem;
  border: 1px solid var(--bs-border-color);
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.list-group-item {
  border: none;
  border-bottom: 1px solid var(--bs-border-color);
}

.list-group-item:last-child {
  border-bottom: none;
}
</style>