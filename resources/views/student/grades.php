<?php
$title = 'My Grades';
?>

<!-- Student Grades Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">My Academic Performance</h1>
      <p class="text-muted mb-0">Detailed view of your grades and progress</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" onclick="exportGrades()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        Export
      </button>
      <button class="btn btn-primary" onclick="printGrades()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-report"></use>
        </svg>
        Print Report
      </button>
    </div>
  </div>
</div>

<!-- Grade Summary Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="87.5" data-count-decimals="1">0</div>
          <div class="text-muted small">Overall Average</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="8">0</div>
          <div class="text-muted small">Passing Subjects</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="2">0</div>
          <div class="text-muted small">Needs Improvement</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-performance"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0">+<span data-count-to="3.2" data-count-decimals="1">0</span>%</div>
          <div class="text-muted small">Improvement</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Grade Filters and Controls -->
<div class="surface p-3 mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Academic Year</label>
      <select class="form-select" id="academicYear">
        <option value="2024-2025" selected>2024-2025</option>
        <option value="2023-2024">2023-2024</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Quarter</label>
      <div class="btn-group w-100" role="group">
        <input type="radio" class="btn-check" name="quarter" id="q1" value="1" checked>
        <label class="btn btn-outline-primary" for="q1">Q1</label>
        <input type="radio" class="btn-check" name="quarter" id="q2" value="2">
        <label class="btn btn-outline-primary" for="q2">Q2</label>
        <input type="radio" class="btn-check" name="quarter" id="q3" value="3">
        <label class="btn btn-outline-primary" for="q3">Q3</label>
        <input type="radio" class="btn-check" name="quarter" id="q4" value="4">
        <label class="btn btn-outline-primary" for="q4">Q4</label>
      </div>
    </div>
    <div class="col-md-3">
      <label class="form-label">Subject</label>
      <select class="form-select" id="subjectFilter">
        <option value="">All Subjects</option>
        <option value="mathematics">Mathematics</option>
        <option value="science">Science</option>
        <option value="english">English</option>
        <option value="filipino">Filipino</option>
        <option value="history">History</option>
        <option value="pe">Physical Education</option>
        <option value="art">Art</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">View</label>
      <div class="btn-group w-100" role="group">
        <input type="radio" class="btn-check" name="viewType" id="detailed" checked>
        <label class="btn btn-outline-primary" for="detailed">Detailed</label>
        <input type="radio" class="btn-check" name="viewType" id="summary">
        <label class="btn btn-outline-primary" for="summary">Summary</label>
      </div>
    </div>
  </div>
</div>

<!-- Grade Charts -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Subject Performance Trend</h5>
        <div class="btn-group btn-group-sm" role="group">
          <input type="radio" class="btn-check" name="chartPeriod" id="weekly" checked>
          <label class="btn btn-outline-primary" for="weekly">Weekly</label>
          <input type="radio" class="btn-check" name="chartPeriod" id="monthly">
          <label class="btn btn-outline-primary" for="monthly">Monthly</label>
          <input type="radio" class="btn-check" name="chartPeriod" id="quarterly">
          <label class="btn btn-outline-primary" for="quarterly">Quarterly</label>
        </div>
      </div>
      <div class="chart-container" style="height: 300px;">
        <canvas id="performanceTrendChart"></canvas>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface p-4">
      <h5 class="mb-4">Grade Distribution</h5>
      <div class="chart-container" style="height: 250px;">
        <canvas id="gradeDistributionChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Detailed Grades Table -->
<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Detailed Grades Breakdown</h5>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary btn-sm" onclick="toggleGradeDetails()">
        <svg class="icon me-1" width="16" height="16" fill="currentColor">
          <use href="#icon-eye"></use>
        </svg>
        Toggle Details
      </button>
      <button class="btn btn-outline-primary btn-sm" onclick="refreshGrades()">
        <svg class="icon me-1" width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
        Refresh
      </button>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover" id="gradesTable">
      <thead class="table-light">
        <tr>
          <th>Subject</th>
          <th>Teacher</th>
          <th>Written Work</th>
          <th>Performance Task</th>
          <th>Quarterly Exam</th>
          <th>Final Grade</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                  <use href="#icon-chart"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Mathematics</div>
                <div class="text-muted small">Grade 10</div>
              </div>
            </div>
          </td>
          <td>Ms. Johnson</td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">85.5</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 85.5%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">88.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 88%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">90.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">87.5</span>
              <div class="progress" style="width: 80px; height: 8px;">
                <div class="progress-bar bg-success" style="width: 87.5%"></div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-success">Passed</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewSubjectDetails('mathematics')">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewAssignments('mathematics')">Assignments</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactTeacher('mathematics')">Contact Teacher</a></li>
              </ul>
            </div>
          </td>
        </tr>
        
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-success" width="16" height="16" fill="currentColor">
                  <use href="#icon-star"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Science</div>
                <div class="text-muted small">Grade 10</div>
              </div>
            </div>
          </td>
          <td>Mr. Smith</td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">90.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">94.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 94%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">93.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-success" style="width: 93%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-success me-2">92.3</span>
              <div class="progress" style="width: 80px; height: 8px;">
                <div class="progress-bar bg-success" style="width: 92.3%"></div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-success">Passed</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewSubjectDetails('science')">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewAssignments('science')">Assignments</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactTeacher('science')">Contact Teacher</a></li>
              </ul>
            </div>
          </td>
        </tr>
        
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                  <use href="#icon-alerts"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">English</div>
                <div class="text-muted small">Grade 10</div>
              </div>
            </div>
          </td>
          <td>Ms. Davis</td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">72.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-warning" style="width: 72%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">78.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-warning" style="width: 78%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">77.0</span>
              <div class="progress" style="width: 60px; height: 6px;">
                <div class="progress-bar bg-warning" style="width: 77%"></div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <span class="fw-semibold text-warning me-2">75.8</span>
              <div class="progress" style="width: 80px; height: 8px;">
                <div class="progress-bar bg-warning" style="width: 75.8%"></div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-warning">Needs Improvement</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewSubjectDetails('english')">View Details</a></li>
                <li><a class="dropdown-item" href="#" onclick="viewAssignments('english')">Assignments</a></li>
                <li><a class="dropdown-item" href="#" onclick="contactTeacher('english')">Contact Teacher</a></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Subject Details Modal -->
<div class="modal fade" id="subjectDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectDetailsTitle">Subject Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="subjectDetailsContent">
          <!-- Content will be loaded dynamically -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Contact Teacher Modal -->
<div class="modal fade" id="contactTeacherModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contact Teacher</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="contactTeacherForm">
          <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" class="form-control" id="contactSubject" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Teacher</label>
            <input type="text" class="form-control" id="contactTeacherName" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea class="form-control" rows="4" placeholder="Type your message here..." required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Priority</label>
            <select class="form-select">
              <option value="low">Low</option>
              <option value="medium" selected>Medium</option>
              <option value="high">High</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="sendMessage()">Send Message</button>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js and Student Grades Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Student Grades Management
class StudentGrades {
  constructor() {
    this.charts = {};
    this.currentQuarter = 1;
    this.currentSubject = '';
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.loadGradesData();
  }

  initializeCharts() {
    // Performance Trend Chart
    const trendCtx = document.getElementById('performanceTrendChart');
    if (trendCtx) {
      this.charts.performanceTrend = new Chart(trendCtx, {
        type: 'line',
        data: {
          labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
          datasets: [
            {
              label: 'Mathematics',
              data: [85, 87, 86, 88, 89, 87, 90, 87.5],
              borderColor: 'rgb(13, 110, 253)',
              backgroundColor: 'rgba(13, 110, 253, 0.1)',
              tension: 0.4,
              fill: true
            },
            {
              label: 'Science',
              data: [90, 91, 89, 92, 93, 91, 94, 92.3],
              borderColor: 'rgb(25, 135, 84)',
              backgroundColor: 'rgba(25, 135, 84, 0.1)',
              tension: 0.4,
              fill: true
            },
            {
              label: 'English',
              data: [75, 76, 74, 77, 76, 75, 78, 75.8],
              borderColor: 'rgb(255, 193, 7)',
              backgroundColor: 'rgba(255, 193, 7, 0.1)',
              tension: 0.4,
              fill: true
            }
          ]
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
              beginAtZero: true,
              max: 100,
              ticks: {
                callback: function(value) {
                  return value + '%';
                }
              }
            }
          },
          interaction: {
            intersect: false,
            mode: 'index'
          }
        }
      });
    }

    // Grade Distribution Chart
    const distributionCtx = document.getElementById('gradeDistributionChart');
    if (distributionCtx) {
      this.charts.gradeDistribution = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['A (90-100)', 'B (80-89)', 'C (70-79)', 'D (60-69)', 'F (Below 60)'],
          datasets: [{
            data: [2, 4, 2, 0, 0],
            backgroundColor: [
              'rgba(25, 135, 84, 0.8)',
              'rgba(13, 110, 253, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(255, 152, 0, 0.8)',
              'rgba(220, 53, 69, 0.8)'
            ],
            borderWidth: 2,
            borderColor: '#fff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                usePointStyle: true,
                padding: 10,
                boxWidth: 10,
                font: {
                  size: 11
                }
              }
            }
          },
          cutout: '60%'
        }
      });
    }
  }

  bindEvents() {
    // Quarter change
    document.querySelectorAll('input[name="quarter"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.currentQuarter = parseInt(e.target.value);
        this.loadGradesData();
      });
    });

    // Subject filter
    document.getElementById('subjectFilter').addEventListener('change', (e) => {
      this.currentSubject = e.target.value;
      this.filterGradesTable();
    });

    // Chart period change
    document.querySelectorAll('input[name="chartPeriod"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.updateChartPeriod(e.target.value);
      });
    });

    // View type change
    document.querySelectorAll('input[name="viewType"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.toggleViewType(e.target.value);
      });
    });
  }

  loadGradesData() {
    // Simulate loading grades data based on quarter
    const quarterData = {
      1: { mathematics: 87.5, science: 92.3, english: 75.8 },
      2: { mathematics: 89.0, science: 94.1, english: 78.2 },
      3: { mathematics: 86.5, science: 90.8, english: 74.5 },
      4: { mathematics: 88.2, science: 93.5, english: 77.1 }
    };

    const data = quarterData[this.currentQuarter];
    this.updateGradesTable(data);
    this.updateCharts(data);
  }

  updateGradesTable(data) {
    // Update table with new data
    const rows = document.querySelectorAll('#gradesTable tbody tr');
    rows.forEach((row, index) => {
      const subject = ['mathematics', 'science', 'english'][index];
      if (data[subject]) {
        const grade = data[subject];
        const finalGradeCell = row.querySelector('td:nth-child(6) span');
        if (finalGradeCell) {
          finalGradeCell.textContent = grade.toFixed(1);
        }
      }
    });
  }

  updateCharts(data) {
    // Update charts with new data
    if (this.charts.performanceTrend) {
      // Update trend chart data
      this.charts.performanceTrend.update();
    }
  }

  filterGradesTable() {
    const rows = document.querySelectorAll('#gradesTable tbody tr');
    rows.forEach(row => {
      const subjectCell = row.querySelector('td:first-child .fw-semibold');
      if (subjectCell) {
        const subject = subjectCell.textContent.toLowerCase();
        if (this.currentSubject === '' || subject.includes(this.currentSubject)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    });
  }

  updateChartPeriod(period) {
    // Update chart data based on period
    const periodData = {
      weekly: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
      monthly: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
      quarterly: ['Q1', 'Q2', 'Q3', 'Q4']
    };

    if (this.charts.performanceTrend) {
      this.charts.performanceTrend.data.labels = periodData[period];
      this.charts.performanceTrend.update();
    }
  }

  toggleViewType(type) {
    const table = document.getElementById('gradesTable');
    if (type === 'summary') {
      table.classList.add('table-sm');
      // Hide detailed columns
      const headers = table.querySelectorAll('th');
      headers.forEach((header, index) => {
        if (index >= 3 && index <= 5) { // WW, PT, QE columns
          header.style.display = 'none';
        }
      });
      const cells = table.querySelectorAll('td');
      cells.forEach((cell, index) => {
        const colIndex = index % 8; // 8 columns total
        if (colIndex >= 3 && colIndex <= 5) {
          cell.style.display = 'none';
        }
      });
    } else {
      table.classList.remove('table-sm');
      // Show all columns
      const headers = table.querySelectorAll('th');
      headers.forEach(header => header.style.display = '');
      const cells = table.querySelectorAll('td');
      cells.forEach(cell => cell.style.display = '');
    }
  }
}

// Global functions
function viewSubjectDetails(subject) {
  const modal = new bootstrap.Modal(document.getElementById('subjectDetailsModal'));
  document.getElementById('subjectDetailsTitle').textContent = `${subject.charAt(0).toUpperCase() + subject.slice(1)} Details`;
  
  // Load subject details content
  document.getElementById('subjectDetailsContent').innerHTML = `
    <div class="row g-4">
      <div class="col-md-6">
        <h6>Grade Breakdown</h6>
        <div class="mb-3">
          <div class="d-flex justify-content-between">
            <span>Written Work (30%)</span>
            <span class="fw-semibold">85.5</span>
          </div>
          <div class="progress" style="height: 6px;">
            <div class="progress-bar bg-primary" style="width: 85.5%"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="d-flex justify-content-between">
            <span>Performance Task (50%)</span>
            <span class="fw-semibold">88.0</span>
          </div>
          <div class="progress" style="height: 6px;">
            <div class="progress-bar bg-success" style="width: 88%"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="d-flex justify-content-between">
            <span>Quarterly Exam (20%)</span>
            <span class="fw-semibold">90.0</span>
          </div>
          <div class="progress" style="height: 6px;">
            <div class="progress-bar bg-info" style="width: 90%"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h6>Recent Assignments</h6>
        <div class="list-group">
          <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Algebra Quiz #3</div>
              <div class="text-muted small">Score: 85/100</div>
            </div>
            <span class="badge bg-success">Completed</span>
          </div>
          <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Geometry Problem Set</div>
              <div class="text-muted small">Score: 88/100</div>
            </div>
            <span class="badge bg-success">Completed</span>
          </div>
        </div>
      </div>
    </div>
  `;
  
  modal.show();
}

function viewAssignments(subject) {
  showNotification(`Loading ${subject} assignments...`, { type: 'info' });
  // Redirect to assignments page
  setTimeout(() => {
    window.location.href = `/student/assignments/${subject}`;
  }, 1000);
}

function contactTeacher(subject) {
  const modal = new bootstrap.Modal(document.getElementById('contactTeacherModal'));
  document.getElementById('contactSubject').value = subject.charAt(0).toUpperCase() + subject.slice(1);
  document.getElementById('contactTeacherName').value = 'Ms. Johnson'; // This should be dynamic
  modal.show();
}

function sendMessage() {
  showNotification('Message sent successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('contactTeacherModal'));
  modal.hide();
}

function exportGrades() {
  showNotification('Exporting grades...', { type: 'info' });
  setTimeout(() => {
    showNotification('Grades exported successfully!', { type: 'success' });
  }, 2000);
}

function printGrades() {
  window.print();
}

function refreshGrades() {
  if (window.studentGradesInstance) {
    window.studentGradesInstance.loadGradesData();
    showNotification('Grades refreshed successfully!', { type: 'success' });
  }
}

function toggleGradeDetails() {
  const table = document.getElementById('gradesTable');
  table.classList.toggle('table-sm');
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.studentGradesInstance = new StudentGrades();
});
</script>

<style>
/* Student Grades Specific Styles */
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

.table-hover tbody tr:hover {
  background-color: var(--bs-table-hover-bg);
}

@media print {
  .btn, .dropdown, .modal {
    display: none !important;
  }
  
  .surface {
    border: 1px solid #ddd !important;
    box-shadow: none !important;
  }
}
</style>
