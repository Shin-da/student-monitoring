<?php
$title = 'Student Progress';
?>

<!-- Teacher Student Progress Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Student Progress Tracking</h1>
      <p class="text-muted mb-0">Monitor and analyze student academic performance</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-report"></use>
        </svg>
        Generate Report
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInterventionModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Create Intervention
      </button>
    </div>
  </div>
</div>

<!-- Progress Overview Cards -->
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
          <div class="h4 fw-bold text-success mb-0" data-count-to="89">0</div>
          <div class="text-muted small">On Track</div>
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
          <div class="h4 fw-bold text-warning mb-0" data-count-to="23">0</div>
          <div class="text-muted small">At Risk</div>
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
          <div class="h4 fw-bold text-danger mb-0" data-count-to="8">0</div>
          <div class="text-muted small">Struggling</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="15">0</div>
          <div class="text-muted small">Excellence</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Progress Analysis Charts -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Performance Trends</h5>
        <div class="btn-group btn-group-sm" role="group">
          <input type="radio" class="btn-check" name="trendView" id="overall" checked>
          <label class="btn btn-outline-primary" for="overall">Overall</label>
          <input type="radio" class="btn-check" name="trendView" id="bySubject">
          <label class="btn btn-outline-primary" for="bySubject">By Subject</label>
          <input type="radio" class="btn-check" name="trendView" id="byClass">
          <label class="btn btn-outline-primary" for="byClass">By Class</label>
        </div>
      </div>
      <div class="chart-container" style="height: 300px;">
        <canvas id="performanceTrendChart"></canvas>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface">
      <h5 class="mb-4">Performance Distribution</h5>
      <div class="chart-container" style="height: 300px;">
        <canvas id="performanceDistributionChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Student Progress Filters -->
<div class="surface mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Class</label>
      <select class="form-select" id="classFilter">
        <option value="">All Classes</option>
        <option value="grade-10-a">Grade 10-A</option>
        <option value="grade-10-b">Grade 10-B</option>
        <option value="grade-9-a">Grade 9-A</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Subject</label>
      <select class="form-select" id="subjectFilter">
        <option value="">All Subjects</option>
        <option value="mathematics">Mathematics</option>
        <option value="science">Science</option>
        <option value="english">English</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Performance Level</label>
      <select class="form-select" id="performanceFilter">
        <option value="">All Levels</option>
        <option value="excellent">Excellent (90+)</option>
        <option value="good">Good (80-89)</option>
        <option value="satisfactory">Satisfactory (70-79)</option>
        <option value="needs-improvement">Needs Improvement (Below 70)</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Search</label>
      <div class="input-group">
        <span class="input-group-text">
          <svg class="icon" width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="Search students..." id="studentSearch">
      </div>
    </div>
  </div>
</div>

<!-- Student Progress Table -->
<div class="surface">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Student Progress Overview</h5>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary btn-sm" onclick="exportProgress()">
        <svg class="icon me-1" width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        Export
      </button>
      <button class="btn btn-outline-primary btn-sm" onclick="refreshProgress()">
        <svg class="icon me-1" width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
        Refresh
      </button>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover" id="progressTable">
      <thead class="table-light">
        <tr>
          <th>Student</th>
          <th>Class</th>
          <th>Overall Grade</th>
          <th>Trend</th>
          <th>Attendance</th>
          <th>Assignments</th>
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
                <div class="fw-semibold">John Doe</div>
                <div class="text-muted small">LRN: 123456789012</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-primary">Grade 10-A</span></td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">92.5</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 92.5%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <svg class="icon text-success me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-up"></use>
              </svg>
              <span class="text-success small">+2.3%</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">95%</span>
              <div class="progress" style="width: 50px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 95%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">18/20</span>
              <div class="progress" style="width: 50px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-success">On Track</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudentDetails(1)">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewStudentGrades(1)">View Grades</a></li>
                <li><a class="dropdown-item" href="#" onclick="createIntervention(1)">Create Intervention</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(1)">Contact Parent</a></li>
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
                <div class="fw-semibold">Jane Smith</div>
                <div class="text-muted small">LRN: 123456789013</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-primary">Grade 10-A</span></td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">78.2</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-warning" style="width: 78.2%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <svg class="icon text-danger me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
              <span class="text-danger small">-1.5%</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">82%</span>
              <div class="progress" style="width: 50px; height: 6px;">
                <div class="progress-bar bg-warning" style="width: 82%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">14/20</span>
              <div class="progress" style="width: 50px; height: 6px;">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-warning">At Risk</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudentDetails(2)">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewStudentGrades(2)">View Grades</a></li>
                <li><a class="dropdown-item" href="#" onclick="createIntervention(2)">Create Intervention</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(2)">Contact Parent</a></li>
              </ul>
            </div>
          </td>
        </tr>
        
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Mike Johnson</div>
                <div class="text-muted small">LRN: 123456789014</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-primary">Grade 10-A</span></td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-danger me-2">65.8</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-danger" style="width: 65.8%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <svg class="icon text-danger me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-arrow-down"></use>
              </svg>
              <span class="text-danger small">-3.2%</span>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-danger me-2">68%</span>
              <div class="progress" style="width: 50px; height: 6px;">
                <div class="progress-bar bg-danger" style="width: 68%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-danger me-2">8/20</span>
              <div class="progress" style="width: 50px; height: 6px;">
                <div class="progress-bar bg-danger" style="width: 40%"></div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-danger">Struggling</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewStudentDetails(3)">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewStudentGrades(3)">View Grades</a></li>
                <li><a class="dropdown-item" href="#" onclick="createIntervention(3)">Create Intervention</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactParent(3)">Contact Parent</a></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generateReportModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generate Progress Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="generateReportForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Report Type</label>
              <select class="form-select" required>
                <option value="">Select Report Type</option>
                <option value="overall">Overall Progress</option>
                <option value="subject">Subject-wise Progress</option>
                <option value="class">Class Progress</option>
                <option value="individual">Individual Student</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Class</label>
              <select class="form-select" required>
                <option value="">Select Class</option>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date Range</label>
              <select class="form-select" required>
                <option value="">Select Period</option>
                <option value="quarter1">1st Quarter</option>
                <option value="quarter2">2nd Quarter</option>
                <option value="quarter3">3rd Quarter</option>
                <option value="quarter4">4th Quarter</option>
                <option value="custom">Custom Range</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Format</label>
              <select class="form-select" required>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
                <option value="csv">CSV</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Include Charts</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="includeCharts" checked>
                <label class="form-check-label" for="includeCharts">
                  Include performance charts and graphs
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="generateReport()">Generate Report</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Intervention Modal -->
<div class="modal fade" id="createInterventionModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Student Intervention</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createInterventionForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Student</label>
              <select class="form-select" required>
                <option value="">Select Student</option>
                <option value="1">John Doe</option>
                <option value="2">Jane Smith</option>
                <option value="3">Mike Johnson</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Intervention Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="tutoring">Tutoring</option>
                <option value="remediation">Remediation</option>
                <option value="study-group">Study Group</option>
                <option value="parent-conference">Parent Conference</option>
                <option value="counseling">Counseling</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Priority Level</label>
              <select class="form-select" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Target Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="4" placeholder="Describe the intervention plan and expected outcomes..."></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Assigned To</label>
              <select class="form-select" multiple>
                <option value="teacher">Teacher</option>
                <option value="counselor">School Counselor</option>
                <option value="parent">Parent/Guardian</option>
                <option value="peer-tutor">Peer Tutor</option>
              </select>
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

<!-- Chart.js and Teacher Student Progress Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Teacher Student Progress Management
class TeacherStudentProgress {
  constructor() {
    this.charts = {};
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.loadProgressData();
  }

  initializeCharts() {
    // Performance Trend Chart
    const trendCtx = document.getElementById('performanceTrendChart');
    if (trendCtx) {
      this.charts.performanceTrend = new Chart(trendCtx, {
        type: 'line',
        data: {
          labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
          datasets: [{
            label: 'Average Grade',
            data: [82, 85, 87, 84, 86, 88],
            borderColor: 'rgba(13, 110, 253, 1)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
          }, {
            label: 'Class Average',
            data: [78, 80, 82, 81, 83, 85],
            borderColor: 'rgba(25, 135, 84, 1)',
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
              min: 70,
              max: 100
            }
          }
        }
      });
    }

    // Performance Distribution Chart
    const distributionCtx = document.getElementById('performanceDistributionChart');
    if (distributionCtx) {
      this.charts.performanceDistribution = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['Excellent (90+)', 'Good (80-89)', 'Satisfactory (70-79)', 'Needs Improvement (<70)'],
          datasets: [{
            data: [15, 25, 18, 8],
            backgroundColor: [
              'rgba(25, 135, 84, 0.8)',
              'rgba(13, 110, 253, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(220, 53, 69, 0.8)'
            ],
            borderColor: [
              'rgba(25, 135, 84, 1)',
              'rgba(13, 110, 253, 1)',
              'rgba(255, 193, 7, 1)',
              'rgba(220, 53, 69, 1)'
            ],
            borderWidth: 2
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
    // Filter changes
    document.getElementById('classFilter').addEventListener('change', () => this.filterStudents());
    document.getElementById('subjectFilter').addEventListener('change', () => this.filterStudents());
    document.getElementById('performanceFilter').addEventListener('change', () => this.filterStudents());

    // Search
    document.getElementById('studentSearch').addEventListener('input', (e) => {
      this.searchStudents(e.target.value);
    });

    // Trend view change
    document.querySelectorAll('input[name="trendView"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.updateTrendView(e.target.value);
      });
    });
  }

  loadProgressData() {
    console.log('Loading progress data...');
    // Load progress data from API
  }

  filterStudents() {
    const className = document.getElementById('classFilter').value;
    const subject = document.getElementById('subjectFilter').value;
    const performance = document.getElementById('performanceFilter').value;

    const rows = document.querySelectorAll('#progressTable tbody tr');
    rows.forEach(row => {
      let show = true;

      if (className && !row.querySelector('td:nth-child(2)').textContent.toLowerCase().includes(className.toLowerCase())) {
        show = false;
      }
      if (subject && !row.querySelector('td:nth-child(3)').textContent.toLowerCase().includes(subject.toLowerCase())) {
        show = false;
      }
      if (performance && !row.querySelector('td:nth-child(7)').textContent.toLowerCase().includes(performance.toLowerCase())) {
        show = false;
      }

      row.style.display = show ? '' : 'none';
    });
  }

  searchStudents(searchTerm) {
    const rows = document.querySelectorAll('#progressTable tbody tr');
    rows.forEach(row => {
      const studentName = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
      
      if (studentName.includes(searchTerm.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  updateTrendView(view) {
    if (view === 'bySubject') {
      // Update chart to show subject-wise trends
      if (this.charts.performanceTrend) {
        this.charts.performanceTrend.data.labels = ['Mathematics', 'Science', 'English', 'Filipino'];
        this.charts.performanceTrend.data.datasets[0].data = [85, 82, 88, 80];
        this.charts.performanceTrend.data.datasets[1].data = [83, 80, 86, 78];
        this.charts.performanceTrend.update();
      }
    } else if (view === 'byClass') {
      // Update chart to show class-wise trends
      if (this.charts.performanceTrend) {
        this.charts.performanceTrend.data.labels = ['Grade 10-A', 'Grade 10-B', 'Grade 9-A'];
        this.charts.performanceTrend.data.datasets[0].data = [87, 85, 82];
        this.charts.performanceTrend.data.datasets[1].data = [85, 83, 80];
        this.charts.performanceTrend.update();
      }
    } else {
      // Update chart to show overall trends
      if (this.charts.performanceTrend) {
        this.charts.performanceTrend.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'];
        this.charts.performanceTrend.data.datasets[0].data = [82, 85, 87, 84, 86, 88];
        this.charts.performanceTrend.data.datasets[1].data = [78, 80, 82, 81, 83, 85];
        this.charts.performanceTrend.update();
      }
    }
  }
}

// Global functions
function viewStudentDetails(studentId) {
  showNotification(`Viewing student details ${studentId}...`, { type: 'info' });
}

function viewStudentGrades(studentId) {
  showNotification(`Viewing student grades ${studentId}...`, { type: 'info' });
}

function createIntervention(studentId = null) {
  if (studentId) {
    showNotification(`Creating intervention for student ${studentId}...`, { type: 'info' });
  } else {
    showNotification('Intervention created successfully!', { type: 'success' });
    const modal = bootstrap.Modal.getInstance(document.getElementById('createInterventionModal'));
    modal.hide();
  }
}

function contactParent(studentId) {
  showNotification(`Contacting parent for student ${studentId}...`, { type: 'info' });
}

function generateReport() {
  showNotification('Generating progress report...', { type: 'info' });
  setTimeout(() => {
    showNotification('Report generated successfully!', { type: 'success' });
  }, 3000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('generateReportModal'));
  modal.hide();
}

function exportProgress() {
  showNotification('Exporting progress data...', { type: 'info' });
  setTimeout(() => {
    showNotification('Progress data exported successfully!', { type: 'success' });
  }, 2000);
}

function refreshProgress() {
  if (window.teacherStudentProgressInstance) {
    window.teacherStudentProgressInstance.loadProgressData();
    showNotification('Progress data refreshed successfully!', { type: 'success' });
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherStudentProgressInstance = new TeacherStudentProgress();
});
</script>

<style>
/* Teacher Student Progress Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.chart-container {
  position: relative;
  max-height: 300px;
  overflow: hidden;
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.table-hover tbody tr:hover {
  background-color: var(--bs-table-hover-bg);
}

.badge {
  font-size: 0.75em;
}

.progress {
  transition: width 0.6s ease;
}

.btn-group .btn-check:checked + .btn {
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
  color: white;
}
</style>
